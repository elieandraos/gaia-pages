<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Vinkla\Translator\Translatable;
use Vinkla\Translator\Contracts\Translatable as TranslatableContract;
use Spatie\MediaLibrary\MediaLibraryModel\MediaLibraryModelInterface;
use Spatie\MediaLibrary\MediaLibraryModel\MediaLibraryModelTrait;

class ComponentPage extends Model implements MediaLibraryModelInterface, TranslatableContract {

	use Translatable, MediaLibraryModelTrait;

	protected $table = 'component_page';
	protected $fillable = ['component_id', 'page_id', 'value', 'params'];
	protected $translatedAttributes = ['value', 'params'];
	protected $translator = 'App\Models\ComponentPageTranslation';
	public $timestamps = false;

	/**
	 * Component Relation
	 * @return type
	 */
	public function component()
	{
		return $this->belongsTo('App\Models\Component');
	}

	/**
	 * Page Relation
	 * @return type
	 */
	public function page()
	{
		return $this->belongsTo('App\Models\Page');
	}


	 /**
     * Return the media collection name
     * @return type
     */
    public function getMediaCollectionName()
    {
    	return "collection-".$this->id;
    }


    /**
     * Image profiles: list of resized images post uploading
     * @return type
     */
	public function getImageProfileProperties()
	{
	    return [
	        'featured' => ['w'=>615, 'h'=>348],
	        'thumb'    => ['w'=>298, 'h'=>198],
	        'thumb-xs' => ['w'=>60, 'h'=>60]
	    ];
	}    


}
