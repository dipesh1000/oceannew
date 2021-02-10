@extends('frontend.layouts.app')
@section('content')
<div id="about_page" style="margin-top: 110px">
    <div class="about_content">
        <div class="container">
            @if($postType->slug == 'authors')
                <h2>Authors</h2>
                <div class="row">
                    @foreach ($posts as $post)
                        <div class="col-md-3">
                            <div class="card">
                                <div class="ditributer-image" style="background-image: url('{{ $post->image ?? asset('assets/img/user.png')}}')"></div>
                                <div class="card-body">
                                    
                                        <h5 class="card-title">{{$post->title}}</h5>
                                    
                                </div>
                                
                                <button class="btn btn-link" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                    Subject
                                </button>
                                <ul class="list-group list-group-flush">
                                    @foreach ($post->subjects as $meta)
                                        <li class="list-group-item">{{ $meta['subjects'] ?? ''}}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else 
                <h2>Distributer</h2>
                <div class="row">
                    @foreach ($posts as $item)
                        <div class="col-md-3">
                            <div class="card">
                                <div class="ditributer-image" style="background-image: url('{{ $item->postMetas[3]->value ?? ''}}')"></div>
                                <div class="card-body">
                                    <h5 class="card-title">{{$item->title}}</h5>
                                </div>
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item">{{ $item->postMetas[0]->value ?? ''}}</li>
                                    <li class="list-group-item">{{ $item->postMetas[1]->value ?? ''}}</li>
                                    <li class="list-group-item">{{ $item->postMetas[2]->value ?? ''}}</li>
                                </ul>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
  </div>
@endsection