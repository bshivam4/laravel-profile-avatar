<?php

namespace App;


use Illuminate\Http\Request;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Session;



class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];


    public function save_image($request){

        $image = $request->file('image');

        //setting image name
        $input['imagename'] = time().'.'.$image->getClientOriginalExtension();

        //setting path where image to be stored
        $destinationPath = public_path('storage/profile_pictures');

        //make an Invention Image object to perform various image processing functions
        $img = Image::make($image->getRealPath());

        //saving the image
        $img->save($destinationPath.'/'.$input['imagename']);

        return back()
            ->with('uploadsuccess','Crop Image')
            ->with('imageName',$input['imagename'])
            ->with('tempPath',$image->getRealPath());
    }

    public function crop_picture(Request $request){

        //getting the picture name which is to be cropped
        $src = $request->imgName;
        //make an Invention Image object to perform various image processing functions
        $img = Image::make('profile_pictures/' . $src);
        //where pictures are to be saved
            $destinationPath = public_path('storage/profile_pictures');

        //if user selects crop area
        if((($request->height)>0) && (($request->width)>0)) {


            //setting crop height,width and margin values
            $height_receive = $request->height;
            $width_receive = $request->width;
            $height_set = (int)(($request->h) * ($img->height()) / ($height_receive));
            $width_set = (int)(($request->w) * ($img->width()) / ($width_receive));
            $xmargin_set = (int)(($request->x) * ($img->width()) / ($width_receive));
            $ymargin_set = (int)(($request->y) * ($img->width()) / ($width_receive));

            //cropping the image
            $img->crop($width_set, $height_set, $xmargin_set, $ymargin_set);
        }

        else{
            //if user has not selected area for cropping, then resizing it
            $img->resize(500, 500);
        }

        $name=Auth::id().'_'.$src;
        //finally saving the cropped/resized image
        $img->save($destinationPath . '/' . $name);

        $user = User::find(Auth::id());
        $picture=asset('storage/profile_pictures') . '/' . $name;
        $user->picture = $picture;
        $user->save();
        Session::put('pictureicon', $picture);
        return view('home')->with('picture',$picture)->with('success','saved');
    }
}
