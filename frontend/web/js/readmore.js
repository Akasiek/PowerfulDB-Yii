$("#read-more").click(() => {
    $("#article").removeClass("h-96");
    $("#read-more").addClass("hidden");
    $("#read-less").removeClass("hidden");
    $("#read-less").addClass("flex");
});

$("#read-less").click(() => {
    $("#article").addClass("h-96");
    $("#read-more").removeClass("hidden");
    $("#read-less").addClass("hidden");

    // Scroll to the top of the article
    $("html, body").animate({ scrollTop: $("#article").offset().top - 120 }, 0);
});
