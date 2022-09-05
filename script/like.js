async function likeFunc(postId, userId) {
    let likesButton = document.getElementById(`like${postId}`);
    let likes = Number(likesButton.innerText);
    let response = await fetch(`../niggod/user/like.php?postId=${postId}&userId=${userId}`, {
        method: "POST"
    })
        .then(response => response.json())
        .then(data => {
            if(data["type"] == 1) {
                likesButton.innerHTML = `<i class=\"bi bi-fire\"></i> ${likes + 1}`;
            }
            else
            {
                likesButton.innerHTML = `<i class=\"bi bi-fire\"></i> ${likes - 1}`;
            }
    });
}