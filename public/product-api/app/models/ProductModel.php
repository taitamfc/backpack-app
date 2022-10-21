<?php
include_once SYSTEM . 'BaseModel.php';
class ProductModel extends BaseModel
{
    private $_table = 'products';
    private $_default_options = [
        'pagination'    => true,
        'limit'         => 20,
        'fields'        => []
    ];
    private $_product_attribute_items = null;
    private $_map_sizes = [];

    public function __construct(){
        parent::__construct();
        $this->setTable($this->_table);
    }
    /* MODEL */
    public function getAll($request = [], $options = []){
        $options = array_merge( $this->_default_options,$options );
        $page = isset($request['page']) ? $request['page'] : 1;
    	$fields = $options['fields'];
        if($options['pagination']){
			
			if( isset( $options['start_id'] ) && $options['start_id'] ){
				$this->_db->where('id',$options['start_id'],'>=');
			}
			if( isset( $options['end_id'] ) && $options['end_id'] ){
				$this->_db->where('id',$options['end_id'],'<=');
			}
			
            $this->_db->pageLimit = $options['limit'];
            $items = $this->_db->ObjectBuilder()->paginate($this->_table, $page,$fields);
            $return['totalPages'] = $this->_db->totalPages;
        }else{
            $items = $this->_db->ObjectBuilder()->get ($this->_table,null,$fields);
        }



        $return['items'] = $items;
		return $return;	
    }

    public function find($id,$options = []){
        $this->_db->where('id',$id);

        $options = array_merge( $this->_default_options,$options );
        $fields = $options['fields'];
        
        $object = $this->_db->ObjectBuilder()->getOne('products',$fields);

        $obj_map_size = $this->get_map_sizes($object->product_type);
        $object->size_supported = [];
        $object->size_map_price = [];
        if( $obj_map_size ){
            $object->size_supported = json_decode($obj_map_size->size_supported,true);
            $object->size_map_price = json_decode($obj_map_size->size_map_price,true);
        }

        if( $object && isset( $options['get_sub'] ) ){
            $attribute_items = $this->get_system_attribute_items();
            $object->pa_color = [];
            $object->pa_size = [];
            $object->variants = [];
            
            $this->_db->where('product_id',$object->id);
            $sub_products = $this->_db->ObjectBuilder()->get('product_childs');
            $object->sub_products = $sub_products;
            if( $object->sub_products ){
                foreach( $object->sub_products as $sub_product ){
                    $key_connect = $sub_product->key_connect;
                    $key_connect_arr = explode('-',$key_connect);
                    $sub_product->color = $attribute_items[$key_connect_arr[0]];
                    $sub_product->size = $attribute_items[$key_connect_arr[1]];

                    $object->pa_color[$key_connect_arr[0]] = $sub_product->color;
                    $object->pa_size[$key_connect_arr[1]] 	= $sub_product->size;
                    if( isset( $options['get_variant'] )  ){
                        if( $object->size_supported ){
                            foreach( $object->size_supported as $key => $size_supported ){
                                $object->variants[] = $this->get_single_variant($sub_product,$size_supported,$object->size_map_price);
                            }
                        }else{
                            $object->variants[] = $this->get_single_variant($sub_product);
                        }
                        
                    }
                }
            }
        }
        
        return $object;
    }

    protected function get_single_variant($sub_product,$size = null,$size_map_price = []){
		$sub_product->image_url = str_replace('UL1500','UL792',$sub_product->image_url);
		$the_price = ( isset( $size_map_price[$size] ) ) ? $sub_product->price + (int)$size_map_price[$size] : $sub_product->price;
		$variation = [
			'attributes' => [
				'attribute_pa_color' 	=> $sub_product->color,
				'attribute_pa_size' 	=> ($size) ? $size : $sub_product->size,
			],
			'availability_html' 	=> '',
			'backorders_allowed' 	=> false,
			'dimensions_html' 		=> 'N/A',
			'display_price' 		=> $the_price,
			'display_regular_price' => $the_price,
			'image' => [
				'title' => $sub_product->title,
				'caption' => $sub_product->title,
				'url' => $sub_product->image_url,
				'alt' => $sub_product->title,
				'src' => $sub_product->image_url,
				'srcset' => '',
				'sizes' => '',
			],
			'image_id' => 0,
			'is_downloadable' => false,
			'is_in_stock' => true,
			'is_purchasable' => true,
			'is_sold_individually' => 'no',
			'is_virtual' => false,
			'max_qty' => null,
			'price_html' => $the_price,
			'sku' => '',
			'variation_description' => '',
			'variation_id' => $sub_product->id,
			'variation_is_active' => true,
			'variation_is_visible' => true,
			'weight' => true,
			'weight_html' => 'N/A'
		];

		return $variation;
	}

    protected function get_system_attribute_items($fields = ['id','title'] ){
		if( $this->_product_attribute_items ){
            return $this->_product_attribute_items;
        }
        
        $items = $this->_db->ObjectBuilder()->get('product_attribute_items',null,$fields);
		$attribute_items = [];
		foreach( $items as $item ){
			$attribute_items[$item->id] = $item->title;
		}
        $this->_product_attribute_items = $attribute_items;
		return $attribute_items;
	}

    protected function get_map_sizes($product_type){

        if( isset( $this->_map_sizes[$product_type] ) ){
            return $this->_map_sizes[$product_type];
        }

        $this->_db->where('name',$product_type);
        $obj_map_size = $this->_db->ObjectBuilder()->getOne('product_types',['name','size_supported','size_map_price']);
        
        $this->_map_sizes[$product_type] = $obj_map_size;
        return $obj_map_size;
    }
}