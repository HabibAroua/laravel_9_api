<?php
    namespace App\Trait;

    use Image;
    use Storage;
    use Illuminate\Support\Str;

    trait ImageProcessing
    {
        public function get_mime($mime)
        {
            switch($mime)
            {
                case 'image/jpeg' : return '.jpg';
                break;
                case 'image/png' : return '.png';
                break;
                case 'image/git' : return '.gif';
                break;
                case 'image/svg+xml' : return '.svg';
                break;
                case 'image/tiff' : return '.tiff';
                break;
                case 'image/webp' : return '.webp';
                break;
            }
        }

        public function saveImage($image)
        {
            $img = Image::make($image);
            $extension = $this->get_mime($img->mime());

            $str_random = Str::random(8);
            $img_path = $str_random.time().$extension;
            $img->save(storage_path('app/imagesfp').'/'.$img_path);
            return $img_path;
        }

        public function aspect4resize($image, $width, $height)
        {
            $img = Image::make($image);
            $extension = $this->get_mime($img->mime());
            $str_random = Str::random(8);

            $img->resize($width, $height, function($constraint){
                $constraint->aspectRatio();
            });

            $img_path = $str_random.time().$extension;
            $img->save(storage_path('app/imagesfp').'/'.$img_path);
            return $img_path;
        }

        public function aspect4height($image, $width, $height)
        {
            $img = Image::make($image);
            $extension = $this->get_mime($img_mime());
            $str_random = Str::random(8);
            $img->resize(null, $height, function($constraint){
                $constraint->aspectRatio();
            });

            if($img->width() < $width)
            {
                $img->resize($width, null);
            }
            else
            {
                if($img->width() > $width)
                {
                    $img->crop($width, $heigh, 0, 0);
                }
            }

            $img_path = $str_random.time().$extension;
            $img->save(storage_path('app/imagesfp').'/'.$img_path);
            return $img_path;
        }

        // minute 11:54
    }
?>