@extends('layouts.app')
@section('content')

    <div class="row no-gutters">
        <div class="col-sm-12">
            <h1 class="m-4">Announcement</h1>
        </div>
        <div class="col-sm-6 my-2">
            <form class="mx-4" action="{{route('admin.post.store')}}" method="post" enctype="multipart/form-data">
                @include('flash.message')
                @csrf
                <div class="custom-file mb-2">
                    <input type="file" name="image" class="custom-file-input @error('image') is-invalid @enderror" id="customFile">
                    <label class="custom-file-label" for="customFile">Attach an image</label>
                </div>
                <textarea class="form-control  @error('caption') is-invalid @enderror"  name="caption" placeholder="What's your message?"></textarea>
                @error('caption')
                <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                <button class="btn btn-primary mt-2 mb-4"><i class="fas fa-edit"></i> Post Announcement</button>
            </form>
            @forelse ($posts as $post)
                <div class="card mx-4 p-4 mt-2 shadow bg-dark text-white">
                    <div class="card-content" style="display: flex; flex-direction: column; gap: 16px;">
                        <div style="display: flex; gap: 16px;">
                            <div class="rounded-circle" style="width: 64px; height: 64px; background-color: red; display: flex; justify-content: center; align-items: center;">
                                <h3 style="margin: 0;">J</h3>
                            </div>
                            <div style="display: flex; flex-direction: column; justify-content: center; flex: 1;">
                                <h3 style="margin: 0;">{{ucfirst($post->user->first_name)." ". ucfirst($post->user->last_name)}} <span class="badge badge-pill badge-small bg-primary" style="font-size: 12pt;">Mayor</span></h3>
                                <small>{{$post->created_at->diffForHumans()}}</small>
                            </div>
                            <div style="display: flex; justify-content: center; gap: 8px; align-items: center;">
                                <div class="postTools" id="postTools-{{$post->id}}">
                                    <button class="btn btn-warning" onclick="editInvoke('{{$post->caption}}','{{$post->id}}')" style="height: fit-content;"><i class="fas fa-edit"></i></button>
                                    <button class="btn btn-danger" onclick="onDelete({{$post->id}})" style="height: fit-content;"><i class="fas fa-trash"></i></button>
                                </div>
                            </div>
                        </div>
                        <div>
                            @if ($post->image)
                                <img src="{{asset('storage/images/posts/'.$post->user->id.'/'.$post->image)}}" class="img-fluid my-4 w-50" alt="image">
                            @endif
                            <p style="margin: 0;" id="caption-{{$post->id}}">{{$post->caption}}</p>
                            <div id="editTools-{{$post->id}}" style="display: none">
                                <textarea id="edit-{{$post->id}}" class="form-control" ></textarea>
                                <div class="buttonsEdit mt-3 d-flex justify-content-end" id="editTools-{{$post->id}}">
                                    <button class="btn btn-success" onclick="onUpdate({{$post->id}})" style="height: fit-content;"><i class="fas fa-check"></i></button>
                                    <button class="btn btn-danger ml-2" onclick="editUnInvoke({{$post->id}})" style="height: fit-content;"><i class="fas fa-times"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="text-center">
                    <h1>You have'nt made any post yet</h1>
                </div>
            @endforelse

        </div>
    </div>

    @push('scripts')
        <script>
            function editInvoke(initialText,id){
                const p = document.getElementById('caption-'+id)
                const editField = document.getElementById("edit-"+id)

                const editTools = document.getElementById("editTools-"+id);
                const postTools = document.getElementById("postTools-"+id);
                p.style.display = "none";
                editField.innerText = p.innerText
                postTools.style.display = "none";
                editTools.style.display = "block";
            }

            function editUnInvoke(id){
                const editTools = document.getElementById("editTools-"+id);
                const postTools = document.getElementById("postTools-"+id);
                const editField = document.getElementById("edit-"+id)
                const p = document.getElementById('caption-'+id)
                p.style.display = "block";

                editField.innerText = "";
                postTools.style.display = "block";
                editTools.style.display = "none";
            }

            function onDelete(postID){
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        axios.delete('/post/admin/delete',{data:{id:postID}}).then(response=>{
                            Swal.fire(
                                'Deleted!',
                                'Your file has been deleted.',
                                'success'
                            ).then(e=>{
                                location.reload();
                            })
                        });
                    }
                })
            }


            function onUpdate(postID){
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You want to update this post?",
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, update it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        const editField = document.getElementById("edit-"+postID)
                        const p = document.getElementById('caption-'+postID);
                        axios.patch('post/admin/update',{id:postID,caption:editField.value}).then(response=>{
                            console.log(document.getElementById('caption-'+postID).innerText)
                            p.innerText = editField.value
                            console.log(document.getElementById('caption-'+postID).innerText)
                            Swal.fire(
                                'Updated!',
                                'Your Post has been updated.',
                                'success'
                            ).then(e=>{
                                location.reload()
                            })

                        });
                    }
                })
            }

        </script>

        <script>
            $(".custom-file-input").on("change", function() {
                var fileName = $(this).val().split("\\").pop();
                $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
            });
        </script>
    @endpush
@endsection
