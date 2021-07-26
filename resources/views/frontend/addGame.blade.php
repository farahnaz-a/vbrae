@extends('layouts.frontend')
@section('title')
    {{ config('app.name') }} - Home Page
@endsection

@section('content')
<section class="game-overview">
    <div class="container">
      <div class="tab-content" id="myTabContent">
        <div
          class="tab-pane fade show active"
          id="add_game"
          role="tabpanel"
          aria-labelledby="home-tab"
        >
          <form action="{{ route('frontend.addGameSave') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="page-content">
              <div class="content-header">
                <h5>Add Game Manual</h5>
              </div>
              <div class="content-body">
                <div class="row">
                  <div class="col-sm-6">
                    <div class="mb-3">
                      <label for="game_name">Game name</label>
                      <div class="input-group">
                        <span
                          class="input-group-text"
                          style="padding: 0.375rem 0.75rem"
                          ><i class="fas fa-edit"></i
                        ></span>
                        <input
                          id="game_name"
                          type="text"
                          class="form-control"
                          name="name"
                          placeholder="Enter the game name"
                        />
                      </div>
                    </div>
                    @error('name')
                    <small style="color:red;">{{ $message }}</small>
                @enderror
                  </div>
                  <div class="col-sm-6">
                    <div class="mb-3">
                      <label for="platform">Select Platform</label>
                      <div class="input-group">
                        <span
                          class="input-group-text"
                          style="padding: 0.375rem 0.75rem"
                          ><i class="fas fa-bullseye"></i
                        ></span>
                        <select id="platform" name="platform_id" class="form-select">
                          <option value="">Select Platform</option>
                          @foreach ($platforms as $item)
                          
                           <option value="{{ $item->id }}">{{ $item->name }}</option>

                          @endforeach
                        </select>
                      </div>
                      @error('platform_id')
                      <small style="color:red;">{{ $message }}</small>
                  @enderror
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="row">
                    <div class="col-sm-6">
                      <div class="mb-3">
                        <label for="releas_date">Release date</label>
                        <div class="input-group">
                          <span
                            class="input-group-text"
                            style="padding: 0.375rem 0.75rem"
                            ><i class="fas fa-calendar"></i
                          ></span>
                          <input
                            id="releas_date"
                            type="date"
                            name="release_date"
                            class="form-control"
                            placeholder="Release date"
                          />
                        </div>
                        @error('release_date')
                        <small style="color:red;">{{ $message }}</small>
                    @enderror
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="mb-3">
                        <label for="publisher">Publisher</label>
                        <div class="input-group">
                          <span
                            class="input-group-text"
                            style="padding: 0.375rem 0.75rem"
                            ><i class="fas fa-calendar"></i
                          ></span>
                          <input
                            id="publisher"
                            type="text"
                            class="form-control"
                            placeholder="Publisher (optional)"
                          />
                        </div>
                      </div>
                    </div>
                    <div class="my-3">
                        <label for="">Game description</label> <br>
                        <textarea class="form-control" name="description" placeholder="Enter description"></textarea>
                      </div>
                      @error('description')
                          <small style="color:red;">{{ $message }}</small>
                      @enderror
                    <div class="col-12">
                      <div class="mb-3">
                        <input name="image" class="form-control" type="file" />
                      </div>
                      @error('image')
                      <small style="color:red;">{{ $message }}</small>
                  @enderror
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="my-3 text-end">
              <button class="btn btn-green">
                <i class="fas fa-plus me-2"></i>Save Game
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </section>
@endsection

@section('js')
<script>
    ClassicEditor.create(document.querySelector('#editor'), {
      removePlugins: ['Heading'],
      toolbar: [
        'bold',
        'italic',
        'underline',
        '|',
        'numberedList',
        'bulletedList',
      ],
    }).catch((error) => {
      console.log(error)
    })
  </script>
@endsection