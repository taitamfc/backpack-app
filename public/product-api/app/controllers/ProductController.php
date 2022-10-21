<?php
// Include base controller to support basic framework fuctions
include SYSTEM . 'BaseController.php';

/**
* Default Controller
*/
class ProductController extends BaseController
{
    protected $productModel;
    public function __construct(){
        $this->productModel = $this->loadModel('ProductModel');
        if( !isset( $_REQUEST['API_KEY'] ) || $_REQUEST['API_KEY'] != API_KEY ){
            $res['msg'] = 'No API_KEY or API_KEY not correct !';
            $res['error'] = 1;
      	    $this->resJson($res,1);
        }
    }
    public function index()
    {
        $data = $this->productModel->getAll($_REQUEST,[
            'limit' => ( isset( $_REQUEST['limit'] ) ) ? $_REQUEST['limit'] : 20,
            'start_id' => ( isset( $_REQUEST['start_id'] ) ) ? $_REQUEST['start_id'] : '',
            'end_id' => ( isset( $_REQUEST['end_id'] ) ) ? $_REQUEST['end_id'] : '',
            'fields'=>[
                'id as system_id',
                // 'title',
                // 'description',
                // 'price',
                // 'image_url',
                // 'product_type'
            ]
        ]);
        $res['data'] = $data;
        $res['msg'] = __METHOD__;
      	$this->resJson($res,1);
    }
    public function show(){
        if( !$_REQUEST['id'] ){
            $res['msg'] = 'id is required paramater';
      	    $this->resJson($res,1);
        }

        $ids = explode(',',$_REQUEST['id']);
        $data = [];
        foreach( $ids as $id ){
            $data[] = $this->productModel->find($id,['get_sub'=>true,'get_variant'=>true]);
        }
        $res['data'] = $data;
        $res['msg'] = __METHOD__;
      	$this->resJson($res,1);
    }
}