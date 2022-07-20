let deletes = document.getElementsByClassName('deletes');
for(let i=0;i<deletes.length;i++){
    deletes[i].addEventListener('click', function(){
        console.log("delete ",deletes[i].id);
        window.location = `/notes-app/index.php?delete=${deletes[i].id}`;
    })
}

let updates = document.getElementsByClassName('updates');
for(let i=0;i<updates.length;i++){
    updates[i].addEventListener('click', function(){
        let form_id = `${updates[i].id}-form`;
        document.getElementById(form_id).style.display = "flex";
    })
}

let formCloses = document.getElementsByClassName("form-close");
for(let i=0;i<formCloses.length;i++){
    formCloses[i].addEventListener('click', function(event){
        event.preventDefault();
        formCloses[i].parentElement.style.display = "none";
    })
}