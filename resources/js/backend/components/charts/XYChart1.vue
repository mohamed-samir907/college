<template>
  <div class="chart1" :id="chartDiv">
  </div>
</template>

<script>
import * as am4core from "@amcharts/amcharts4/core";
import * as am4charts from "@amcharts/amcharts4/charts";
import am4themes_animated from "@amcharts/amcharts4/themes/animated";

am4core.useTheme(am4themes_animated);

export default {
  props: ["data", "chartDiv"],

  data () {
    return {
      dataArray: [
        {"count": 20, "month": "January"}
      ]
    }
  },

  methods: {
    setData() {
      this.dataArray = JSON.parse(this.$props.data);
    },

    buildChart() {
      // Create chart instance
      var chart = am4core.create(this.chartDiv, am4charts.XYChart);
      chart.scrollbarX = new am4core.Scrollbar();
      
      // Add data
      chart.data = this.dataArray;
      
      // Create axes
      var categoryAxis = chart.xAxes.push(new am4charts.CategoryAxis());
      categoryAxis.dataFields.category = "month";
      categoryAxis.renderer.grid.template.location = 0;
      categoryAxis.renderer.minGridDistance = 30;
      categoryAxis.renderer.labels.template.horizontalCenter = "right";
      categoryAxis.renderer.labels.template.verticalCenter = "middle";
      categoryAxis.renderer.labels.template.rotation = 270;
      categoryAxis.tooltip.disabled = true;
      categoryAxis.renderer.minHeight = 110;
      categoryAxis.renderer.grid.template.disabled = true;
      
      var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());
      valueAxis.calculateTotals = false;
      valueAxis.strictMinMax = false;
      valueAxis.renderer.minWidth = 50;
      
      // Create series
      var series = chart.series.push(new am4charts.ColumnSeries());
      series.sequencedInterpolation = true;
      series.dataFields.valueY = "count";
      series.dataFields.categoryX = "month";
      series.tooltipText = "[{categoryX}: bold]{valueY}[/]";
      series.columns.template.strokeWidth = 0;
      
      series.tooltip.pointerOrientation = "vertical";
      
      series.columns.template.column.cornerRadiusTopLeft = 10;
      series.columns.template.column.cornerRadiusTopRight = 10;
      series.columns.template.column.fillOpacity = 0.8;
      
      // on hover, make corner radiuses bigger
      var hoverState = series.columns.template.column.states.create("hover");
      hoverState.properties.cornerRadiusTopLeft = 0;
      hoverState.properties.cornerRadiusTopRight = 0;
      hoverState.properties.fillOpacity = 1;
      
      series.columns.template.adapter.add("fill", function(fill, target) {
        return chart.colors.getIndex(target.dataItem.index);
      });

      chart.cursor = new am4charts.XYCursor();
    }
  },

  mounted() {
    this.setData();

    this.buildChart();
  },

  beforeDestroy() {
    am4core.disposeAllCharts();
  }
}
</script>

<style scoped>
.chart1 {
  width: 100%;
  height: 400px;
}
</style>