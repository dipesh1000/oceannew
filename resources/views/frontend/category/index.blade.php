@extends('frontend.layouts.app')
@section('content')
<div id="product_page">
    <div class="container-fluid book_filter">
       <div class="filter_title" data-toggle="collapse" data-target="#filter_list">
           <a><i class="fas fa-filter"></i>Book Filter</a>
       </div>
 
   <div class="collapse" id="filter_list"> 
            <aside>
               <div class="aside_header">
                   Categories
               </div>
               @foreach ($child_cat as $cat)   
               <div class="aside_drop" data-toggle="collapse" data-target="#drop1">
               <span>{{ $cat->title }}</span> 
                   <span>&blacktriangledown;</span>
               </div>
               <div class="collapse" id="drop1"> 
                   <div class="aside_list">
                      <a href="">
                           Textbooks
                      </a> 
                   </div>
                </div>
               @endforeach
           </aside>
   </div>
</div>


<div class="container-fluid">
   <div class="row">
       <div class="col-2 asider">
           <aside>
               <div class="aside_header">
                   Categories  
               </div>
               @foreach ($child_cat as $cat)  
                    @foreach ($cat->childs as $item) 
                        <div class="aside_drop" data-toggle="collapse" data-target="#drop1">
                            {{-- <a href="{{ route('category.single', $item->slug) }}">
                            <span>{{ $item->title }}</span> 
                            </a> --}}
                        <li id="cat{{$item->id}}" class="selectCategory" value="{{$item->id}}">{{ $item->title }}</li>
                            <span>&blacktriangledown;</span>
                        </div>
                        @foreach ($item->childs as $inner_cat)
                            <div class="collapse" id="drop1"> 
                                <div class="aside_list">
                                    {{-- <a href="{{ route('category.single', $inner_cat->slug) }}">
                                        {{$inner_cat->title}}
                                    </a>  --}}
                                    <li id="cat{{$inner_cat->id}}" class="selectCategory" value="{{$inner_cat->id}}">{{$inner_cat->title}}</li>
                                </div>
                            </div>
                        @endforeach
                    @endforeach
                @endforeach
           </aside>
       </div>

       <div class="col-12  col-md-10">
           <main>
               <div class="bread_container">
                   <ul class="bread">
                       <li><a href=""> <i class="fa fa-home"></i> Home &gt; </a></li>
                       <li><a href="">Engineering Entrances &gt;</a></li>
                       <li><a href="">JEE Main And Advanced </a></li>
                   </ul>
               </div>

               <div id="booksData">
                   <div class="row">
                        @include('frontend.category.books')
                    </div>
                </div>
                <nav aria-label="Page navigation example">
                   <ul class="pagination">
                   <li class="page-item"><a class="page-link" href="#">Previous</a></li>
                   <li class="page-item"><a class="page-link" href="#">1</a></li>
                   <li class="page-item"><a class="page-link" href="#">2</a></li>
                   <li class="page-item"><a class="page-link" href="#">3</a></li>
                   <li class="page-item"><a class="page-link" href="#">Next</a></li>
                   </ul>
                </nav>
           </main>
       </div>

   </div>
</div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type="text/javascript">
    $(function( $ ){
         
            $(".selectCategory").click(function(){
                var cat = $(this).val();
                // alert(ppp);
                $.ajax({
                    type: 'GET',
                    dataType: 'html',
                    url: "{{ url('/bookByCat') }}",
                    data: 'cat_id=' + cat,
                    success: function(response){
                        $("#booksData").html(response);
                    }
                });
            });
            
    });
    
</script>
        
@endsection




