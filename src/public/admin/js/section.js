let Section = {
    el: document.querySelector('#sort_table'),
    data: null,
    url: null,
    create: function (data) {
        this.data = data;
        console.log(this);
        return this;
    },
    update: function (data) {
        this.data = data;
        console.log(this);
        return this;
    },
    sort: function (data) {
        this.url = config.url.sort;

        /** データの整理
         * サーバに渡すための[<セクションテーブルのid>,...]の配列をつくりたい
         */
        let arr = [];
        for(const element of Array.from(this.el.getElementsByClassName('no'))) {
            arr.push(element.getAttribute('data-section-id'));
        }
        this.data = { 'sort_data' : arr };

        return this;
    },
    destory: function (data) {
        this.url = null;
    },
    send: function () {
        try {
            if(!this.url|!this.data) throw new Error('URLが無いか、または送信データがありません')
            $.ajax({
                method: 'POST',
                url: this.url,
                data: this.data,
                headers: {
                    'X-CSRF-TOKEN': config.csrf_token,
                },
            }).done(function( data ) {
                if(!data) alert('順番を変更することができませんでした') 
            }) 
        } catch(err) {
            alert(err);
        }
       return this;
    },
}