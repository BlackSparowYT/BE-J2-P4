<form method="POST" class="form" action="{{ route('dashboard.category.delete', $category->slug) }}">
    @csrf

    <div class="form__box">
        <h3>Are you sure you want to delete this item?</h3>
        <input type="submit" name="delete" class="btn btn--danger btn--small" value="Yes, delete it!">
    </div>

</form>
