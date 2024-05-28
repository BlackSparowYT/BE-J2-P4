<form enctype="multipart/form-data" method="POST" class="form" action="{{ route('dashboard.menu.update', $item->slug) }}">
    @csrf

    <div class="form__box">
        <div class="col">
            <h3>Title</h3>
            <input required name="title" value="<?= $item->title ?>">
        </div>
        <div class="col">
            <h3>Slug</h3>
            <input required name="slug" value="<?= $item->slug ?>">
        </div>
    </div>
    <div class="form__box">
        <div class="col">
            <h3>Category</h3>
            <select required name="category" id="">
                @foreach (\App\Models\Category::all() as $category)
                    <option value="{{ $category->id }}" @if($category->id == $item->category_id) selected @endif>{{ $category->title }}</option>
                @endforeach
            </select>
        </div>
        <div class="col">
            <h3>Image (WIP)</h3>
            <input required type="file" name="media">
        </div>
    </div>
    <div class="form__box">
        <div class="col">
            <h3>Content</h3>
            <textarea required name="content"><?= $item->content ?></textarea>
        </div>
        <div class="col">
            <h3>Excerpt</h3>
            <textarea required name="excerpt"><?= $item->excerpt ?></textarea>
        </div>
    </div>
    <div class="form__box">
        <input type="submit" name="edit" class="btn btn--primary btn--small" value="Save">
    </div>


</form>
