async function likeFunc(postId, userId) {
    let likesButton = document.getElementById(`like${postId}`);
    let likes = Number(likesButton.innerText);
    let response = await fetch(`../user/like.php?postId=${postId}`, {
        method: "POST"
    })
        .then(response => response.json())
        .then(data => {
            switch (data["type"]) {
                case 0:
                    likesButton.innerHTML = `<i class=\"bi bi-fire\"></i> ${likes - 1}`;
                    break;

                case 1:
                    likesButton.innerHTML = `<i class=\"bi bi-fire\"></i> ${likes + 1}`;
                    break;

                default:
                    break;
            }
    });
}