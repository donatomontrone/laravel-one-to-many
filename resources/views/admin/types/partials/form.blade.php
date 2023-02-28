
<form action="{{ route($route, $type->id) }}" method="POST" class="form-floating"  enctype="multipart/form-data">
    @csrf
    @method($method)
    <div class="row mb-3">
                    {{-- Name --}}
        <div class="col-md">
            <div class="form-floating">
                <input type="text" class="form-control  @error('name') is-invalid @enderror" id="nameInput" placeholder="Type Name" value="{{ old('name', $type->name) }}" name="name">
                <label for="nameInput">Insert the type name</label>
                <div id="nameInput" class="invalid-feedback">
                @error('name')
                    {{$message}}
                @enderror
                </div>
            </div>
        </div>
                    {{-- Color --}}
        <div class="col-md">
            <div class="form-floating">
                <textarea class="form-control @error('color') is-invalid @enderror" placeholder="Type color" id="inputColor" name="color">{{  old('color',  $type->color) }}</textarea>
                <label for="inputColor">Insert a HEX color code</label>
                <div id="inputColor" class="invalid-feedback">
                    @error('color')
                        {{$message}}
                    @enderror
                </div>
            </div>
        </div>
    </div>
        </div>
        <div class="buttons d-flex justify-content-between">
            <button type="submit" class="btn btn-outline-primary"><i class="fa-regular fa-paper-plane"></i> Submit</button>
            <a href="{{route('admin.types.index')}}" class="btn btn-outline-secondary"><i class="fa-solid fa-arrow-left"></i> Back</a>
        </div>

    </div>
</form>