<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Auth;
use App\Models\Category;

use App\Models\Book;


class CategoryController extends Controller
{
    //

    public function __construct(){
        $this->middleware('auth');
    }


    public function search_Method(Request $request){
        $books = Book::all();
        return view('search' , compact('books'));
    }

    public function search_Method2(Request $request){

        $book = new Book();
        $book->name = $request->book_name;
        $book->type = $request->book_type;
        $book->save(); 
        

        return redirect()->route('sasa_search2');
    }

    public function search_Method3($id){
        $mybook = Book::find($id);
        $books = Book::all()->where('type' , $mybook->type);

        return view('search' , compact('books'));
    }

    public function AllCat(){
        ///* EloquentORM Get Data *///  
        //$categories = Category::all()->paginate(4);
        $categories = Category::latest()->paginate(5);
        $trashedCat = Category::onlyTrashed()->latest()->paginate(3);

        //* QueryBuilder Get Data *//
        // $categories = DB::table('categories')->latest()->paginate(4);

        // How to joine to tables together using QueryBuilder  // 
        // $categories = DB::table('categories')
        // ->join('users' , 'categories.user_id' , 'users.id')
        // ->select('categories.*' , 'users.name')
        // ->latest()->paginate(5);

        
        return view('admin.category.index',compact('categories','trashedCat'));
    } 

    public function AddCat(Request $request){

        $validateCatergory = $request->validate([
            'category_name' => 'required|unique:categories|max:255'
        ],[
            'category_name.required' => 'Please Insert Category Name !!!',
            'category_name.max' => 'Category Less Than 255Chars'
        ]);

        /* EloquentORM Insert Data 1 */
      /*  Category::Insert([
            'category_name' => $request->category_name,
            'user_id' => Auth::user()->id,
            'created_at' => Carbon::now()
        ]);*/

        
        /* EloquentORM Insert Data 2 */
        $category = new Category();
        $category->category_name = $request->category_name;
        $category->user_id = Auth::user()->id;
        $category->save();

        /* QueryBuilder Insert Data */
        /*$data = array();
        $data['category_name'] = $request->category_name;
        $data['user_id'] = Auth::user()->id;
        DB::table('categories')->insert($data);*/
        
        return redirect()->back()->with('success','Category Inserted Successfull');
    }

    public function Edit($id){

        //* EloquentORM  *//
        // $category = Category::find($id);

        //* QueryBuilder *//
        $category = DB::table('categories')->where('id',$id)->first();

        return view('admin.category.edit',compact('category'));
    }

    public function Update(Request $request,$id){
        //* EloquentORM Update  *//
        // $update_category = Category::find($id)->update([
        //     'category_name' => $request->category_name,
        //     'user_id' => Auth::user()->id
        // ]);

        //* QueryBuilder Update  *//
        $update_category = Array();
        $update_category['category_name'] = $request->category_name;
        $update_category['user_id'] = Auth::user()->id;
        
        DB::table('categories')->where('id',$id)->update($update_category);

        return redirect()->route('all.category')->with('success' , 'Category Update Successfull');
    }

    public function SoftDelete($id){
        $trashedCat = Category::find($id)->delete();

        
        return redirect()->route('all.category')->with('success' , 'Category Soft Delete Successfull');
    }

    public function Restore($id){
        $restoreCat = Category::withTrashed()->find($id)->restore();

        return redirect()->back()->with('success','Category Restored Successfull');
    }

    public function Pdelete($id){
        $pdelete = Category::onlyTrashed()->find($id)->forceDelete();
        return redirect()->back()->with('success','Category Permanently Successfull');
    }
}
