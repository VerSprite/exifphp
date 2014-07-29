exifphp
=======

A vulnerable application to demonstrate smuggling PHP code through EXIF data.

This application has three easily defeatable controls to prevent uploading files that aren't JPEGS.  The first control is JavaScript which attempts to check the file extension before upload.  The last two are implemented in PHP, and essentially just validate that the file is actually a JPEG.  

There is zero controls around the actual file extension, which allows you to append ".php", ".php5", etc to the file in transit.  This aids in the overall code execution of the PHP smuggled into JPEG's EXIF data.

Configuration
=============

  - Create a uploads directory and make sure uploads.php points to it
  - Configure the Bootstrap directories as you see fit
  - This was built and deployed on Apache 
