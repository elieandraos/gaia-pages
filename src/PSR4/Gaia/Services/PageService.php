<?php namespace Gaia\Services;

use Image;
use File;

class PageService
{
	
	/**
	 * Returns the upload path (and creates it recursively)
	 * @param type $page 
	 * @return type
	 */
    public function getUploadsPath($page)
	{
		$path = public_path()."/uploads/pages/".$page->id."/";
		File::exists($path) or File::makeDirectory($path, 0755, true);
		return $path;
	}


	/**
	 * Handles the image upload for the page
	 * @param type $page 
	 * @return type
	 */
	public function uploadImage($page, $uploaded_image)
	{
		$filename = NULL;
		if($uploaded_image && $page)
		{
			$image = Image::make($uploaded_image->getRealPath()); 
			$filename = $uploaded_image->getClientOriginalName();
			$image->save($this->getUploadsPath($page).$filename);
			$image->resize(32, 32, function($constraint){ $constraint->aspectRatio(); });
			$image->save($this->getUploadsPath($page)."thumb-xs-".$filename);
		}
		return $filename;
	}

	
	/**
	 * Removes the image and its thumb
	 * @param type $page 
	 * @return type
	 */
	public function removeImage($page, $imageName)
	{
		if($page && $imageName)
		{
			$image = $this->getUploadsPath($page).$imageName;
			$thumb = $this->getUploadsPath($page)."thumb-xs-".$imageName;
			File::delete([$image, $thumb]);
		}
	}

}

?>