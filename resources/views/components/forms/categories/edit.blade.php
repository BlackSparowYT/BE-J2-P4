<form method="POST" class="form" action="{{ route('dashboard.category.update', $category->slug) }}">
    @csrf

    <div class="form__box">
        <div class="col">
            <h3>Title</h3>
            <input required name="title" value="<?= $category->title ?>">
        </div>
        <div class="col">
            <h3>Slug</h3>
            <input required name="slug" value="<?= $category->slug ?>">
        </div>
    </div>
    <div class="form__box">
        <input type="submit" name="edit" class="btn btn--primary btn--small" value="Save">
    </div>

</form>
