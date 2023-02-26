<!DOCTYPE html>
<html>
<head>
  <script src="https://cdn.plot.ly/plotly-latest.min.js"></script>
  <style>
    .plotly-graph-div {
      width: 100%;
      height: 100%;
    }
  </style>
</head>
<body>
  <div id="plotly-graph"></div>
  <script>
    fetch("https://cve.circl.lu/api/cve/CVE-2019-11358")
      .then(response => response.json())
      .then(data => {
        Plotly.newPlot("plotly-graph", [{
          x: data.references,
          y: data.references,
          type: "bar"
        }]);
      });
  </script>
</body>
</html>
