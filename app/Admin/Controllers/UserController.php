<?php

namespace App\Admin\Controllers;

use App\Group;
use App\User;

use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    use ModelForm;

    /**
     * Index interface.
     *
     * @return Content
     */
    public function index()
    {
        return Admin::content(function (Content $content) {

            $content->header('header');
            $content->description('description');

            $content->body($this->grid());
        });
    }

    /**
     * Edit interface.
     *
     * @param $id
     * @return Content
     */
    public function edit($id)
    {
        return Admin::content(function (Content $content) use ($id) {

            $content->header('header');
            $content->description('description');

            $content->body($this->form()->edit($id));
        });
    }

    /**
     * Create interface.
     *
     * @return Content
     */
    public function create()
    {
        return Admin::content(function (Content $content) {

            $content->header('header');
            $content->description('description');

            $content->body($this->form());
        });
    }

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Admin::grid(User::class, function (Grid $grid) {

            $grid->img("Picture")->display(function ($img){
                $path= Storage::url($img);
                return "<img src='".$path."' alt='Profile Picture' width='70' height='70' />";
            });

            $grid->id('ID')->sortable();
            $grid->name("Full Name");
            $grid->email("Email Address");
            $grid->groups("Joint Groups")->display(function ($groups) {

                $groups = array_map(function ($group) {
                    return "<span class='label label-primary'>{$group['name']}</span>";
                }, $groups);

                return join('&nbsp;', $groups);
            });

//            $grid->senders("Joint Members(senders)")->display(function ($senders) {
//
//                $senders = array_map(function ($sender) {
//                    return "<span class='label label-primary'>{$sender['name']}</span>";
//                }, $senders);
//
//                return join('&nbsp;', $senders);
//            });
//
//            $grid->receivers("Joint Members(receivers)")->display(function ($receivers) {
//
//                $receivers = array_map(function ($receiver) {
//                    return "<span class='label label-primary'>{$receiver['name']}</span>";
//                }, $receivers);
//
//                return join('&nbsp;', $receivers);
//            });

            $grid->created_at();
        });
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        return Admin::form(User::class, function (Form $form) {

            $form->display('id', 'ID');
            $form->text("name", "Full Name")->rules("required");
            $form->email("email", "Email Address")->rules("required");
            $form->password("password", "password")->rules("required");
            $form->image("img", "Profile Picture");

            $form->multipleSelect('groups', "Joint Groups")->options(Group::all()->pluck('name', 'id'));

            $form->display('created_at', 'Created At');
            $form->display('updated_at', 'Updated At');

            $form->saving(function (Form $form) {
                if($form->model()->id){
                    if(!$form->password){
                        $user= User::find($form->model()->id);
                        $form->password = $user->password;
                    }else{
                        $form->password = hash::make($form->password);
                    }
                }else{
                    $form->password = hash::make($form->password);
                }
            });

        });
    }
}
