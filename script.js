$('.new').click(function (event) {
    event.preventDefault(); // デフォルトのリンク動作を無効化
    $('#post').show(); // フォームをスライドで表示/非表示
});

$(document).ready(function() {
    // 0時から23時までの選択肢を追加する処理
    for (let i = 0; i < 24; i++) {
        let hour = i.toString().padStart(2, '0') + ":00";
        $('#start_time, #end_time').append(`<option value="${hour}">${hour}</option>`);
    }
});


$(document).ready(function() {
    var selectedTags = [];

    // タグのクリックイベント
    $('.tag').on('click', function() {
        var tag = $(this).data('tag');
        
        // 既に選択されているか確認
        if ($(this).hasClass('selected')) {
            // 選択解除の処理
            $(this).removeClass('selected');
            selectedTags = selectedTags.filter(function(item) {
                return item !== tag; // 選択解除されたタグを配列から削除
            });
        } else {
            // 新たに選択されたタグを追加
            $(this).addClass('selected');
            selectedTags.push(tag);
        }

        // 選択されたタグを隠しフィールドにセット
        $('#selectedTags').val(selectedTags.join(', '));
    });
});

