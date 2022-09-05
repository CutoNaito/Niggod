async function likeFunc(postId, userId) {
    let likes = Number(document.getElementById(`like${postId}`).innerText);
    let likesButton = document.getElementById(`like${postId}`);
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