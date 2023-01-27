<?php 

class File {
 
    protected $filename;
    protected $filesize;
    protected $filetype;
    protected $fileerror;
    protected $filetmp;
    protected $removefile = null;
  
    public function __construct($filename, $filesize, $filetype, $fileerror, $filetmp) {
        $this->filename = $filename;
        $this->filesize = $filesize;
        $this->filetype = $filetype;
        $this->fileerror = $fileerror;
        $this->filetmp = $filetmp;
    }

    public function getFile(){

        $filenames =  $this->uploadFile();
        //exec komutu ile exiftool çalıştırıyoruz.
        exec("exiftool images\\".$filenames, $output);
        return $output;

    
    }

    public function uploadFile(){
        $name = $this->filename;
        $size = $this->filesize;
        $type = $this->filetype;
        $error = $this->fileerror;
        $tmp = $this->filetmp;
       
        //mb cinsinden dosya boyutu hesaplama
        $size = $size / 1024 / 1024;
        $size = round($size, 2);

        if($error === 0){
            //eğer dosya boyutu 2mb den küçükse işlemlere devam ediyoruz.
            if($size < 2){
                //explode ile dosya uzantısını ayırıyoruz.
                $fileExt = explode(".", $name);
                //strtolower ile dosya uzantısını küçük harfe çeviriyoruz.
                $fileActualExt = strtolower(end($fileExt));
                //dosya uzantılarını belirliyoruz.
                $allowed = array("jpg", "jpeg", "png");
                //in_array ile dosya uzantısını kontrol ediyoruz.
                if(in_array($fileActualExt, $allowed)){
                    //uniqid ile dosya ismini değiştiriyoruz.
                    $fileNameNew = uniqid("", true).".".$fileActualExt;
                    //dosya yolu belirliyoruz.
                    $fileDestination = "images/".$fileNameNew;
                    //move_uploaded_file ile dosyayı belirtilen yere taşıyoruz.
                    move_uploaded_file($tmp, $fileDestination);
    
                    return $fileNameNew; 
                    
                }else{
                    header("Location:upload.php?error=typeerror");
                }
                //eğer dosya boyutu 1mb den büyükse ekrana uyarı yazdırıyoruz.
            }else{
                header("Location:upload.php?error=sizeerror");
            }
        }else{
           header("Location:upload.php?error=uploaderror");
        }
    }


}

    




