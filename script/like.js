async function likeFunc(postId, userId) {
    console.log(postId);
    console.log(userId);
    let likesButton = document.getElementById(`like${postId}`);
    let likes = Number(likesButton.innerText);
    let response = await fetch(`../user/like.php?postId=${postId}&userId=${userId}`, {
        method: "POST"
    })
        .then(response => response.json())
        .then(data => {
            if(data["type"] == 1) {
                console.log(data)
                likesButton.innerHTML = `<i class=\"bi bi-fire\"></i> ${likes + 1}`;
            }
            else
            {
                console.log(data)
                likesButton.innerHTML = `<i class=\"bi bi-fire\"></i> ${likes - 1}`;
            }
    });
}