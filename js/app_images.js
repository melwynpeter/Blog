let image_id = document.getElementById('image_id');
console.log("The image id is: ", image_id.value);

// like and dislike algo
// like
let like = document.getElementById('like');
let likeNumber = document.getElementById('likeNumber');

// to display likes
let likeCount = document.getElementById('likeCount');

// dislike
let dislike = document.getElementById('dislike');
let dislikeNumber = document.getElementById('dislikeNumber');

//  to display dislikes
let dislikeCount = document.getElementById('dislikeCount');

// like add event listener
like.addEventListener('click', likeHandler);


function likeColorHandler(){
    if(like.style.color == "black" || (dislike.style.color == "white" && dislikeNumber.value == -1)){
        like.style.color = "white";
        likeNumber.value = 1;
        dislike.style.color = "black";
        dislikeNumber.value = 0;
    }
    else{
        like.style.color = "black";
        likeNumber.value = 0;
    }
}

function likeHandler(){
    likeColorHandler();
    console.log("You have clicked the like button");


    // async form request
    // Instanciating the object
    const xhr = new XMLHttpRequest();

    // opening the object
    xhr.open('POST', 'partials\/_handle_likesanddislikes_images.php', true);

    // xhr.getResponseHeader('Content-type', 'application/x-www-form-urlencoded');
    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

    // What to do when onload
    xhr.onload = function (){
        if(this.status == 200){
            console.log(this.responseText);
        }
        else{
            console.log("Some error occured");
        }
    }

    // send

    let data = "likeNumber=" + likeNumber.value + "&imageId=" + image_id.value;
    xhr.send(data);
}

// dislike add event listener

dislike.addEventListener('click', dislikeHandler);

function dislikeColorHandler(){
    if(dislike.style.color == "black" || (like.style.color == "white" && likeNumber.value == 1)){
        dislike.style.color = "white";
        dislikeNumber.value = -1;
        like.style.color = "black";
        likeNumber.value = 0;
    }
    else{
        dislike.style.color = "black";
        dislikeNumber.value = 0;
    }
}

function dislikeHandler(){
    dislikeColorHandler();
    console.log("You have clicked the dislike button");
    
    
    // async form request
    // Intanciate an xhr object
    const xhr = new XMLHttpRequest();

    // opening the object
    xhr.open('POST', 'partials\/_handle_likesanddislikes_images.php', true);

    // calling the set request header function
    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

    // What to do when onload
    xhr.onload = function (){
        if(this.status == 200){
            console.log(this.responseText);
        }
        else{
            console.log("Some error occurred");
        }
    }

    // send
    let data = "likeNumber=" + dislikeNumber.value + "&imageId=" + image_id.value;
    xhr.send(data);
}





