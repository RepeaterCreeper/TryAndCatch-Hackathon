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
        confirmButtonText: 'Yes, delete it!'
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
