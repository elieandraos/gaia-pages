<?php namespace Gaia\Services;

class PageService
{
	
	/**
	 * Handles the image upload for the components inside the page
	 * @param type $componentPage 
	 * @return type
	 */
	public function uploadImage($componentPage, $uploaded_image)
	{
		$componentPage->removeMediaCollection($componentPage->getMediaCollectionName());
		
		$file = $uploaded_image;
		$tempDirectory = storage_path('temp');
		$fileName = $file->getClientOriginalName();

		$file->move($tempDirectory, $fileName);
		$collectionName = $componentPage->getMediaCollectionName();

		$componentPage->addMedia($tempDirectory . '/' . $fileName, $collectionName);
	}


	/**
	 * Removes the componentPage image
	 * @param type $componentPage 
	 * @return type
	 */
	public function removeImage($componentPage)
	{
		$componentPage->removeMediaCollection($componentPage->getMediaCollectionName());
	}


}
?>