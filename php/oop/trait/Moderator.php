<?php

namespace trait;

require_once 'Image.php';
require_once 'Wallpaper.php';


class User
{
    //ВОТ ЭТО ТРЕЙТ ПЕРЕОПРЕДЕЛИТ 11-22
    private string $path;

    public function getImage():string
    {
        echo "user <br> ";
        return $this->path;
    }
    public function setImage(string $path):void
    {
        $this->path =$path;
    }
    public function __construct(
        public string $email,
        private string $password,
        public ?string $first_name = null,
        public ?string $last_name = null)
    {}

    public function fullName() : string
    {
        $arr_name = array_filter([$this->first_name, $this->last_name]);
        $full_name = implode(' ', $arr_name);
        return empty($full_name) ? 'Анонимный пользователь' : $full_name ;

    }
}
class BackendUser extends User {}
class Moderator extends BackendUser
{
    /*будет выведен модератор трейт не переопределит
     * private string $path;

    public function getImage():string
    {
        echo "moderator <br> ";
        return $this->path;
    }
    public function setImage(string $path):void
    {
        $this->path =$path;
    }*/

    use Image , Wallpaper{
       // Image::getImage insteadof Wallpaper;
       // Image::setImage insteadof Wallpaper;
        Wallpaper::getImage insteadof Image;
        Wallpaper::setImage insteadof Image;
        Image::getImage as getimages;
        Image::setImage as setimages;
        //если оставить 57 и 58 то будет wallpaper если 56 и 55 будет image если оставить всё то user
    }

}

$user = new Moderator(
    'asdf@gmail.com',
    'password',
    'Игорь',
    'Иванов');
$user->setimage('avatar.png');
echo $user->getimage();
echo '<br>';
echo $user->getimages();
echo '<br>';
echo $user->fullName();