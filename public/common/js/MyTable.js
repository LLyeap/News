function MyTable() {
    this._caption = '';
    this._th = [];
    this._data = [];

    this.setCaption = function (caption) {
        this.caption = caption;
    };
    this.getCaption = function () {
        return this.caption;
    };

    this.setTh = function (th) {
        this.th = th;
    };
    this.getTh = function () {
        return this.th;
    };

    this.setData = function (data) {
        this.data = data;
    };
    this.getData = function () {
        return this.data;
    };

    this.getTable = function () {
        var table = '';
        table += '<table class="table table-striped table-bordered">';

        // catpion
        table += '<caption>' + this.caption + '</caption>';

        // thead
        table += '<thead>';
        table += '<tr>';
        for(key in this.data[0]) {
            table += '<th>' + key + '</th>';
        }
        table += '<th>' + 'operation' + '</th>';
        table += '</tr>';
        table += '<thead>';

        // tbody
        table += '<tbody>';
        for(index in this.data) {
            table += '<tr>';
            for (key in this.data[index]) {
                table += '<td>' + this.data[index][key] + '</td>'; // 这里数据得根据一个key来安放, 暂时先这样, 这里还需要一个双层循环
            }
            table += '<td>';
            table += '<div class="btn-group">';
            table += '<button type="button" id="update" value="' + this.data[index]['id'] + '" class="btn btn-default" data-toggle="modal" data-target="#myModal">修改</button>';
            table += '<button type="button" id="delete"  value="' + this.data[index]['id'] + '" class="btn btn-default">删除</button>';
            table += '</div>';
            table += '</td>';

            table += '</tr>';
        }
        table += '<tbody>';

        table += '</table>';

        // 返回表格拼装字符串
        return table;
    };
}