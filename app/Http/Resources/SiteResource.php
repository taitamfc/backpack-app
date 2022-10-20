<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SiteResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'site_title' => $this->site_title,
            'tagline' => $this->tagline,
            'tagline' => $this->tagline,
            'site_domain' => $this->site_domain,
            'administration_email_address' => $this->administration_email_address,
            'web_hook' => $this->web_hook,
            'site_phone' => $this->site_phone,
            'contact_email_address' => $this->contact_email_address,
            'site_address' => $this->site_address,
            'site_map' => $this->site_map,
            'site_open_hours' => $this->site_open_hours,
            'topbar_content' => $this->topbar_content,
            'product_start_id' => $this->product_start_id,
            'product_end_id' => $this->product_end_id,
            'product_limit_per_call' => $this->product_limit_per_call,
            'product_call_interval' => $this->product_call_interval,
            // 'product_detail_api_url' => $this->product_detail_api_url,
            'product_detail_limit_per_call' => $this->product_detail_limit_per_call,
            'product_detail_call_interval' => $this->product_detail_call_interval,
            'import_to_wp_limit_per_call' => $this->import_to_wp_limit_per_call,
            'import_to_wp_interval' => $this->import_to_wp_interval,
        ];
    }
}