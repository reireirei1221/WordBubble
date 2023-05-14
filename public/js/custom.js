// ページが読み込まれたら実行する処理
    window.onload = function() {
      // キャンバス要素を取得する
    const canvas = document.getElementById('myCanvas');
    const context = canvas.getContext('2d');
    
    // アニメーションの間隔を設定する（ミリ秒）
    const interval = 50;
    // 円の半径を設定する
    const radius = 20;
    
    // 円の位置を設定する変数
    let x = canvas.width / 2;
    let y = canvas.height / 2;
    
    // アニメーションを実行する関数
    function animate() {
      // キャンバスをクリアする
      context.clearRect(0, 0, canvas.width, canvas.height);
      
      // 新しい位置を計算する
      x += (Math.random() * 20) - 10;
      y += (Math.random() * 20) - 10;
      
      // 円を描画する
      // context.beginPath();
      // context.arc(x, y, radius, 0, Math.PI * 2, false);
      // context.fillStyle = '#ff0000';
      // context.fill();
      
      // アニメーションを継続する
      requestAnimationFrame(animate);
    }
    
    // アニメーションを開始する
    animate();
    
      // アニメーションの間隔を設定する（ミリ秒）
      const interval = 5000;
      // アニメーションの範囲を設定する
      const range = 30;
      
      // ページ内の .floating-text 要素を取得する
      const circles = document.querySelectorAll('.circle');
      console.log(circles);
      // アニメーションを実行する関数
      function animate() {
        circles.forEach(function(circles) {
          // 現在の位置を取得する
          const x = text.dataset.x;
          const y = text.dataset.y;
          
          // 新しい位置を計算する
          const newX = x + (Math.random() * range * 2) - range;
          const newY = y + (Math.random() * range * 2) - range;
          
          // 新しい位置に移動する
          text.style.transform = `translate(${newX}px, ${newY}px)`;
          
          // 新しい位置をデータ属性に保存する
          text.dataset.x = newX;
          text.dataset.y = newY;
        });
      }
      
      // アニメーションを開始する
      setInterval(animate, interval);
     };