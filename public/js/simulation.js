// 力学シミュレーションの設定

var simulation = d3.forceSimulation(nodes)
    .force("center", d3.forceCenter(width / 2, height / 2)) // 中心に引力を設定
    .force("charge", d3.forceManyBody().strength(-30)) // 各円同士の斥力を設定
    .force("collision", d3.forceCollide().radius(function (d) { return d.r; })) // 衝突判定を設定
    .on("tick", ticked); // シミュレーションの更新時に呼ばれる関数を設定

// シミュレーションの更新時に呼ばれる関数
function ticked() {
    var circles = svg.selectAll("circle")
        .attr("cx", function (d) { return d.x; })
        .attr("cy", function (d) { return d.y; });
}