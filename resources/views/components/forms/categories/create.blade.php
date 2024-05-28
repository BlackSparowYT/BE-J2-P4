<form method="POST" class="form" action="{{ route('dashboard.category.add') }}">
    @csrf

    <div class="form__box">
        <div class="col">
            <h3>Title</h3>
            <input required name="title">
        </div>
        <div class="col">
            <h3>Slug</h3>
            <input required name="slug">
        </div>
    </div>
    <div class="form__box">
        <input type="submit" name="add" class="btn btn--primary btn--small" value="Save">
    </div>

</form>
