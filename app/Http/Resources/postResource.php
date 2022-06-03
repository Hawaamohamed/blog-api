<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;


//******** resources: convert data to json for send it as api to front end or mobile developer *********//
class postResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        //this return all data of post
        //return parent::toArray($request);

        //this return specific data
        return [
            'id' => $this->id,
            'title' => $this->title,
            'content' => $this->content, 
            'user_id' => $this->user_id,
            'created_at' => $this->created_at->format('d-m-Y'),
            'updated_at' => $this->updated_at->format('d-m-Y'),
        ];



    }
}
