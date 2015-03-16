<?php

namespace Mederi;

use google\appengine\api\cloud_storage\CloudStorageTools;

class ImageController
{  
  
  /**
   * Show the HTML form to submit a file
   * @return string HTML output
   */
  public static function form()
  {
    $options    = ['gs_bucket_name' => self::getBucketName()];
    $upload_url = CloudStorageTools::createUploadUrl('/images/upload', $options);

    require 'views/image-form.phtml';
  }

  /**
   * Send the submited file to the Google Cloud Storage
   * @return string HTML output
   */
  public static function upload()
  {
    $gs_filename = $_FILES['imagem']['tmp_name'];
    $filename    = $_FILES['imagem']['name'];    

    move_uploaded_file($gs_filename, $url = self::getUrl($filename));    

    printf('<a href="%s">Link</a>', 
           CloudStorageTools::getImageServingUrl($url));
  }

  /**
   * Get an URL using the Google Cloud Storage format
   * Ex: gs://bucket_name/path/to/file
   * @param  string $filename
   * @return string GS Url format   
   */
  private static function getUrl($filename)
  {
    return sprintf(self::getFilenameFormat(), self::getBucketName(), $filename);
  }

  /**
   * Get the GS Bucket name
   * @return string Bucket name
   */
  private static function getBucketName()
  {
    return getenv('GS_BUCKET_NAME');
  }

  /**
   * Get the pattern for the Google Cloud Storage URL format
   * @return string Google Cloud Storage pattern
   */
  private static function getFilenameFormat()
  {
    return getenv('GS_FILENAME_FORMAT');
  }

}