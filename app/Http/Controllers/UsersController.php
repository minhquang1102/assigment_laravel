<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Requests\UserRequest;

class UsersController extends Controller
{
    public function index()
    {
        // Eloquent
        // all: lay ra toan bo cac ban ghi
        $users = User::all();
        // get: lay ra toan bo cac ban ghi, ket hop dc cac dieu kien #
        // get se nam cuoi cung cua doan truy van
        $usersGet = User::select('*')
            ->orderBy('id', 'desc')
            ->paginate(10);

        return view('users.index', ['users' => $usersGet]);
        // dd('Danh sach category', $categories, $categoriesGet);
    }

    public function create()
    {
        return view('users.create');
    }

    public function store(UserRequest $request)
    {
        // Validate
        // $request->validate([
        //     // name nào sẽ validate điều kiện gì
        //     'name' => 'required|min:6|max:32',
        //     'description' => 'min:6',
        //     'status' => 'required'
        // ]);
        // Nếu có lỗi trong điều kiện truyền vào thì tự động kết thúc
        // hàm và quay trở lại form kèm biến $errors

        $userRequest = $request->all();
        $user = new User();
        $user->name = $userRequest['name'];
        $user->date = $userRequest['date'];
        $user->email = $userRequest['email'];
        $user->password = $userRequest['password'];
        // use Illuminate\Support\Str;

        $user->save();

        return redirect()->route('users.index');
    }

    public function edit(User $id)
    {
        // Neu khong sd model binding
        // $cate = Category::find($id);
        // $id bây giờ không phải 1 số mà là đối tương Category có id = id trên param

        // 1. Nếu việc gọi đến phương thức mà không có cú pháp gọi hàm
        // -> trả về 1 collection (array object), giống all()
        $users = $id->users; // $id là 1 thể hiện của model Category
        // dd($id, $id
        // ->products()->select('name')->paginate(10));
        // 2. Nếu việc gọi đến phương thức có cú pháp gọi hàm
            // -> tiến hành query tiếp được và get() hoặc paginate()
        $usersWithPaginate = $id
            ->users()->select('name')->paginate(10);
        return view('users.create', [
            'user' => $id,
            'users' => $usersWithPaginate
        ]);
    }

    public function update(UserRequest $request, User $id)
    {
        // $request->validate([
        //     // name nào sẽ validate điều kiện gì
        //     'name' => 'required|min:6|max:32',
        //     'description' => 'min:6',
        //     'status' => 'required'
        // ]);

        // $cateUpdate chinh la doi tuong Category co id = $id
        $userUpdate = $id;
        // Gan gia tri moi cho doi tuong $cateUpdate
        $userUpdate->name = $request->name;
        $userUpdate->date = $request->date;
        $userUpdate->email = $request->email;
        $userUpdate->password = $request->password;
        // Thuc thi viec luu du lieu moi vao DB
        $userUpdate->update();
        // Quay ve danh sach
        return redirect()->route('users.index');
    }

    public function delete(User $id_users) {
        // Neu muon su dung model binding
        // 1. Dinh nghia kieu tham so truyen vao la model tuong ung
        // 2. Tham so o route === ten tham so truyen vao ham
        if ($id_users->delete()) {
            return redirect()->route('users.index');
        }

        // Cach 1: destroy, tra ve id cua thang duoc xoa
        // Chi ap dung khi nhan vao tham so la gia tri
        // Neu k xoa duoc thi tra ve 0
        $userDelete = User::destroy($id);
        if ($userDelete !== 0) {
            return redirect()->route('users.index');
        }
        // dd($categoryDelete);

        // Cach 2: delete, tra ve true hoac false
        // $category = Category::find($id);
        // $category->delete();
    }
}
