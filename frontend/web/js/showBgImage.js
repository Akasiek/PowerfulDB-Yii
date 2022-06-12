const showBgImage = (bgInputId, userImgId, noImageUrl) => {
    const bgImgUrl = document.getElementById(bgInputId);
    const userImg = document.getElementById(userImgId);

    bgImgUrl.addEventListener('input', (e) => {
        const url = e.target.value;
        if (isImage(url)) userImg.src = url;
        else userImg.src = noImageUrl;
    });
}