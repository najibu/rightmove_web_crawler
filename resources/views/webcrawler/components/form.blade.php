<form class="row g-2 mt-3" action="{{ route('search') }}">
    <div class="col-auto">
      <input type="text"
        class="form-control"
        id="postcode"
        placeholder="Postcode"
        name="postcode"
        value=""
        minlength="3"
        required>
    </div>

    <div class="col-auto">
        <button type="submit" class="btn btn-primary mb-3">Search</button>
    </div>
</form>

