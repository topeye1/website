let Card = function (idx, level, params) {
    let tag = '';
    tag += '<div className="card shadow mb-4 mr-3 col-3">';
    tag += '    <div className="card-body">';
    tag += '        <div className="chart-area">';
    tag += '            <canvas id="myAreaChart"></canvas>';
    tag += '        </div>';
    tag += '    </div>';
    tag += '</div>';
    return this;
}
