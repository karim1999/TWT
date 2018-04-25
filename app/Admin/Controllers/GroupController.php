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
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class GroupController extends Controller
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
        return Admin::grid(Group::class, function (Grid $grid) {

            $grid->img("Picture")->display(function ($img){
                $path= Storage::url($img);
                return "<img src='".$path."' alt='Profile Picture' width='70' height='70' />";
            });

            $grid->id('ID')->sortable();
            $grid->name("Group Name");
            $grid->user_id("Group Owner")->display(function ($id){
                if($id){
                    $user= User::findOrFail($id);
                    return $user->name;
                }else{
                    return "Admin";
                }
            });
            $grid->description("Group Description")->limit(30);
            $grid->members("Group Members")->display(function ($members) {

                $members = array_map(function ($member) {
                    return "<span class='label label-primary'>{$member['name']}</span>";
                }, $members);

                return join('&nbsp;', $members);
            });

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
        return Admin::form(Group::class, function (Form $form) {

            $form->display('id', 'ID');
            $form->text("name", "Group Name")->rules("required");
            $form->password("password", "password")->help('Leave it empty for open groups.');
            $form->image("img", "Group Picture");
            $form->textarea("description", "Group Discription");

            $form->multipleSelect('members', "Group Members")->options(User::all()->pluck('name', 'id'));

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
