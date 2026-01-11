<?php

namespace App\Helpers\Admin;

use App\Models\Blog;
use App\Models\UserCurrency;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Str;


use Illuminate\Support\Facades\Validator;

class AdminBlogHelper {

   public static function index()
    {
        $blogs = Blog::latest()->paginate(10);

        return view('admin.blogs.blogs', compact('blogs'));
    }


    public static function add()
    {
        return view('admin.blogs.add-blog');
    }


    public static function save(Request $request)
    {
        $validated = $request->validate([
            'title'            => 'required|string|max:255',
            'subtitle'         => 'nullable|string|max:255',
            'content'          => 'required|string',

            'meta_title'       => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',
            'meta_keywords'    => 'nullable|string',

            'featured_image'   => 'nullable|image|mimes:jpeg,png,jpg,webp|max:3072',

            'author_name'      => 'required|string|max:100',
            'author_position'  => 'nullable|string|max:100',

            'published_at'     => 'nullable|date',
            'is_active'        => 'sometimes|boolean',
        ]);

        DB::beginTransaction();

        try {
            /** SLUG GENERATION */
            $baseSlug = Str::slug($validated['title']);
            $slug = $baseSlug;
            $count = 1;

            while (Blog::where('slug', $slug)->exists()) {
                $slug = $baseSlug . '-' . $count++;
            }

            /** IMAGE UPLOAD */
            $imageName = null;

            if ($request->hasFile('featured_image')) {
                $file = $request->file('featured_image');

                // Generate unique & clean filename
                $imageName = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();

                // Store file in public/uploads/supplier-payments
                $file->storeAs('/blogs', $imageName, 'public');
            }



            /** CREATE BLOG */
            $blog = Blog::create([
                'title'            => $validated['title'],
                'slug'             => $slug,
                'subtitle'         => $validated['subtitle'] ?? null,
                'content'          => $validated['content'],
                'featured_image'   => $imageName,

                'meta_title'       => $validated['meta_title'] ?? null,
                'meta_description' => $validated['meta_description'] ?? null,
                'meta_keywords'    => $validated['meta_keywords'] ?? null,

                'is_active'        => true,
                'published_at'     => $validated['published_at'] ?? null,

                'author_name'      => $validated['author_name'],
                'author_position'  => $validated['author_position'] ?? null,
            ]);

            DB::commit();

            return response()->json([
                'status' => 'success',
                    'msg' => 'Blog addd successfully!',
                ]);

        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'status'  => 'error',
                'message' => $e->getMessage(),
            ], 500);
        }
    }



    public static function edit(Request $request, $id)
    {
        $blog = Blog::with([

            ])
            ->where('id', $id)
            ->firstOrFail();

        // Pass data to the edit view
        return view('admin.blogs.edit-blog', compact('blog'));
    }


    public static function update(Request $request)
    {
        $validated = $request->validate([
            'id'               => 'required|exists:blogs,id',
            'title'            => 'required|string|max:255',
            'subtitle'         => 'nullable|string|max:255',
            'content'          => 'required|string',

            'meta_title'       => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',
            'meta_keywords'    => 'nullable|string',

            'featured_image'   => 'nullable|image|mimes:jpeg,png,jpg,webp|max:3072',

            'author_name'      => 'required|string|max:100',
            'author_position'  => 'nullable|string|max:100',

            'published_at'     => 'nullable|date',
            'is_active'        => 'sometimes|boolean',
        ]);

        DB::beginTransaction();

        try {
            $id = $request->input('id');

            // Fetch the blog
            $blog = Blog::findOrFail($id);

            /** SLUG GENERATION */
            if ($blog->title !== $validated['title']) {
                $baseSlug = Str::slug($validated['title']);
                $slug = $baseSlug;
                $count = 1;

                while (Blog::where('slug', $slug)->where('id', '!=', $blog->id)->exists()) {
                    $slug = $baseSlug . '-' . $count++;
                }
                $blog->slug = $slug;
            }

            /** IMAGE UPLOAD */
            if ($request->hasFile('featured_image')) {
                $file = $request->file('featured_image');

                // Generate unique filename
                $imageName = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();

                // Store in public/blogs
                $file->storeAs('blogs', $imageName, 'public');

                // Delete old image if exists
                if ($blog->featured_image && Storage::disk('public')->exists('blogs/' . $blog->featured_image)) {
                    Storage::disk('public')->delete('blogs/' . $blog->featured_image);
                }

                $blog->featured_image = $imageName;
            }

            // Update other fields
            $blog->title            = $validated['title'];
            $blog->subtitle         = $validated['subtitle'] ?? null;
            $blog->content          = $validated['content'];
            $blog->meta_title       = $validated['meta_title'] ?? null;
            $blog->meta_description = $validated['meta_description'] ?? null;
            $blog->meta_keywords    = $validated['meta_keywords'] ?? null;
            $blog->is_active        = $request->has('is_active') ? true : false;
            $blog->published_at     = $validated['published_at'] ?? null;
            $blog->author_name      = $validated['author_name'];
            $blog->author_position  = $validated['author_position'] ?? null;

            $blog->save();

            DB::commit();

            return response()->json([
                'status' => 'success',
                'msg'    => 'Blog updated successfully!',
            ]);

        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'status'  => 'error',
                'message' => $e->getMessage(),
            ], 500);
        }
    }




    public static function view(Request $request, $id)
    {
        // Fetch the specific blog
        $blog = Blog::where('id', $id)->firstOrFail();

        // Pass data to the view page
        return view('admin.blogs.view-blog', compact('blog'));
    }



        


    public static function filter(Request $request)
{
    $query = Blog::query();

    if ($request->filled('title')) {
        $query->where('title', 'like', '%'.$request->title.'%');
    }

    if ($request->filled('subtitle')) {
        $query->where('subtitle', 'like', '%'.$request->subtitle.'%');
    }

    if ($request->filled('author_name')) {
        $query->where('author_name', 'like', '%'.$request->author_name.'%');
    }

    if ($request->filled('status')) {
        $query->where('is_active', $request->status);
    }

    if ($request->filled('published_from')) {
        $query->whereDate('published_at', '>=', $request->published_from);
    }

    if ($request->filled('published_to')) {
        $query->whereDate('published_at', '<=', $request->published_to);
    }

    $blogs = $query->orderBy('id', 'desc')->paginate(10);

    // Render Blade partial for table rows
  return view('admin.blogs.table', compact('blogs'))->render();


}





  public static function destroy(Request $request, $id)
    {
        try {
            // Fetch the blog by ID
            $blog = Blog::findOrFail($id);

            // Soft delete the blog
            $blog->delete();

            // Optional: Log the deletion
            Log::info("Blog deleted", [
                'blog_id' => $blog->id,
                'title'   => $blog->title,
            ]);

            return response()->json([
                'status' => 'success',
                'msg'    => 'Blog deleted successfully.'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'msg'    => 'An error occurred while deleting the blog: ' . $e->getMessage()
            ], 500);
        }
    }



    public static function update_status(Request $request)
    {
        $messages = [
            'id.required'     => 'The Blog ID is required.',
            'status.required' => 'The Status is required.',
        ];

        $rules = [
            'id'     => 'required|integer|exists:blogs,id',
            'status' => 'required|boolean',
        ];

        $validatedData = $request->validate($rules, $messages);

        try {
            $blogId = $validatedData['id'];

            // Fetch the blog
            $blog = Blog::findOrFail($blogId);

            // Update status
            $blog->is_active = $validatedData['status'];
            $blog->save();

            // Optional: Log the status change
            Log::info("Blog status updated", [
                'blog_id' => $blog->id,
                'title'   => $blog->title,
                'new_status' => $blog->is_active ? 'Active' : 'Inactive',
                'updated_by' => Auth::id(),
            ]);

            return response()->json([
                'status' => 'success',
                'msg'    => 'The blog status has been updated successfully.'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'msg'    => 'An error occurred while updating the status: ' . $e->getMessage()
            ], 500);
        }
    }





}