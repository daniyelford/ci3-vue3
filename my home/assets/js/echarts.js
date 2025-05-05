$(function(e) {
	'use strict'
	/*----Echart2----*/
	var chartdata = [{
		name: ' فروش ',
		type: 'bar',
		barMaxWidth: 20,
		data: [10, 15, 9, 18, 10, 15]
	},  {
		name: ' رشد ',
		type: 'bar',
		barMaxWidth: 20,
		data: [10, 14, 10, 15, 9, 25]
	}];
	var chart = document.getElementById('echart1');
	var barChart = echarts.init(chart);
	var option = {
		valueAxis: {
			axisLine: {
				lineStyle: {
					color: 'rgba(171, 167, 167,0.2)'
				}
			},
			splitArea: {
				show: true,
				areaStyle: {
					color: ['rgba(171, 167, 167,0.2)']
				}
			},
			splitLine: {
				lineStyle: {
					color: ['rgba(171, 167, 167,0.2)']
				}
			}
		},
		grid: {
			top: '6',
			right: '0',
			bottom: '17',
			left: '25',
		},
		xAxis: {
			data:['1394', '1395', '1396', '1397', '1398', '1399'],
			axisLine: {
				lineStyle: {
					color: 'rgba(171, 167, 167,0.2)'
				}
			},
			splitLine: {
				lineStyle: {
					color: 'rgba(171, 167, 167,0.2)'
				}
			},
			axisLabel: {
				fontSize: 10,
				color: '#5f6d7a'
			}
		},
		tooltip: {
			trigger: 'axis',
			position: ['35%', '32%'],
		},
		yAxis: {
			splitLine: {
				lineStyle: {
					color: 'rgba(171, 167, 167,0.2)'
				}
			},
			axisLine: {
				lineStyle: {
					color: 'rgba(171, 167, 167,0.2)'
				}
			},
			axisLabel: {
				fontSize: 10,
				color: '#5f6d7a'
			}
		},
		series: chartdata,
		color: ['#285cf7', '#f7557a' ]
	};
	barChart.setOption(option);


	/*----Echart2----*/
	var chartdata2 = [{
		name: ' فروش ',
		type: 'line',
		smooth: true,
		data: [10, 15, 9, 18, 10, 15],
		color: ['#285cf7']
	}, {
		name: ' سود ',
		type: 'line',
		smooth: true,
		size: 10,
		data: [10, 14, 10, 15, 9, 25],
		color: ['#f7557a']
	}];
	var chart2 = document.getElementById('echart2');
	var barChart2 = echarts.init(chart2);
	var option2 = {
		grid: {
			top: '6',
			right: '0',
			bottom: '17',
			left: '25',
		},
		xAxis: {
			data:['1394', '1395', '1396', '1397', '1398', '1399'],
			splitLine: {
				lineStyle: {
					color: 'rgba(171, 167, 167,0.2)'
				}
			},
			axisLine: {
				lineStyle: {
					color: 'rgba(171, 167, 167,0.2)'
				}
			},
			axisLabel: {
				fontSize: 10,
				color: '#5f6d7a'
			}
		},
		tooltip: {
			trigger: 'axis',
			position: ['35%', '32%'],
		},
		yAxis: {
			splitLine: {
				lineStyle: {
					color: 'rgba(171, 167, 167,0.2)'
				}
			},
			axisLine: {
				lineStyle: {
					color: 'rgba(171, 167, 167,0.2)'
				}
			},
			axisLabel: {
				fontSize: 10,
				color: '#5f6d7a'
			}
		},
		series: chartdata2,
		color: ['#285cf7', '#f7557a' ]
	};
	barChart2.setOption(option2);


	/*----Echart3----*/
	var option3 = {
		grid: {
			top: '6',
			right: '0',
			bottom: '17',
			left: '32',
		},
		xAxis: {
			type: 'value',
			axisLine: {
				lineStyle: {
					color: 'rgba(119, 119, 142, 0.2)'
				}
			},
			axisLabel: {
				fontSize: 10,
				color: '#5f6d7a'
			},
			splitLine: {
				lineStyle: {
					color: 'rgba(171, 167, 167,0.2)'
				}
			},
		},
		tooltip: {
			trigger: 'axis',
			position: ['35%', '32%'],
		},
		yAxis: {
			type: 'category',
			data:['1394', '1395', '1396', '1397', '1398', '1399'],
			splitLine: {
				lineStyle: {
					color: 'rgba(171, 167, 167,0.2)'
				}
			},
			axisLine: {
				lineStyle: {
					color: 'rgba(171, 167, 167,0.2)'
				}
			},
			axisLabel: {
				fontSize: 10,
				color: '#5f6d7a'
			}
		},
		series: chartdata,
		color: ['#285cf7', '#f7557a']
	};
	var chart3 = document.getElementById('echart3');
	var barChart3 = echarts.init(chart3);
	barChart3.setOption(option3);


	/*----Echart4----*/
	var option4 = {
		grid: {
			top: '6',
			right: '0',
			bottom: '17',
			left: '32',
		},
		xAxis: {
			type: 'value',
			axisLine: {
				lineStyle: {
					color: 'rgba(171, 167, 167,0.2)'
				}
			},
			axisLabel: {
				fontSize: 10,
				color: '#5f6d7a'
			},
			splitLine: {
				lineStyle: {
					color: 'rgba(171, 167, 167,0.2)'
				}
			},
		},
		tooltip: {
			trigger: 'axis',
			position: ['35%', '32%'],
		},
		yAxis: {
			type: 'category',
			data:['1394', '1395', '1396', '1397', '1398', '1399'],
			splitLine: {
				lineStyle: {
					color: 'rgba(171, 167, 167,0.2)'
				}
			},
			axisLine: {
				lineStyle: {
					color: 'rgba(171, 167, 167,0.2)'
				}
			},
			axisLabel: {
				fontSize: 10,
				color: '#5f6d7a'
			}
		},
		series: chartdata2,
		color: ['#f7557a', '#285cf7', '#43d7ef']
	};
	var chart4 = document.getElementById('echart4');
	var barChart4 = echarts.init(chart4);
	barChart4.setOption(option4);


	/*----Echart5----*/
	var chartdata3 = [{
		name: ' فروش ',
		type: 'bar',
		barMaxWidth: 20,
		stack: 'Stack',
		data: [10, 15, 9, 18, 10, 15]
	}, {
		name: ' سود ',
		type: 'bar',
		stack: 'Stack',
		barMaxWidth: 20,
		data: [10, 14, 10, 15, 9, 25]
	}];
	var option5 = {
		grid: {
			top: '6',
			right: '0',
			bottom: '17',
			left: '25',
		},
		xAxis: {
			data:['1393','1394', '1395', '1396', '1397', '1398', '1399'],
			axisLine: {
				lineStyle: {
					color: 'rgba(171, 167, 167,0.2)'
				}
			},
			axisLabel: {
				fontSize: 10,
				color: '#5f6d7a'
			}
		},
		tooltip: {
			trigger: 'axis',
			position: ['35%', '32%'],
		},
		yAxis: {
			splitLine: {
				lineStyle: {
					color: 'rgba(171, 167, 167,0.2)'
				}
			},
			axisLine: {
				lineStyle: {
					color: 'rgba(171, 167, 167,0.2)'
				}
			},
			axisLabel: {
				fontSize: 10,
				color: '#5f6d7a'
			}
		},
		series: chartdata3,
		color: ['#f7557a', '#285cf7']
	};
	var chart5 = document.getElementById('echart5');
	var barChart5 = echarts.init(chart5);
	barChart5.setOption(option5);


	/*----Echart6----*/
	var option6 = {
		grid: {
			top: '6',
			right: '10',
			bottom: '17',
			left: '32',
		},
		xAxis: {
			type: 'value',
			axisLine: {
				lineStyle: {
					color: 'rgba(171, 167, 167,0.2)'
				}
			},
			axisLabel: {
				fontSize: 10,
				color: '#5f6d7a'
			}
		},
		tooltip: {
			trigger: 'axis',
			position: ['35%', '32%'],
		},
		yAxis: {
			type: 'category',
			data:['1393','1394', '1395', '1396', '1397', '1398', '1399'],
			splitLine: {
				lineStyle: {
					color: 'rgba(171, 167, 167,0.2)'
				}
			},
			axisLine: {
				lineStyle: {
					color: 'rgba(171, 167, 167,0.2)'
				}
			},
			axisLabel: {
				fontSize: 10,
				color: '#5f6d7a'
			}
		},
		series: chartdata3,
		color: ['#f7557a', '#285cf7']
	};
	var chart6 = document.getElementById('echart6');
	var barChart6 = echarts.init(chart6);
	barChart6.setOption(option6);


	/*----Echart7----*/
	var chartdata4 = [{
		name: ' اطلاعات ',
		type: 'line',
		data: [5, 15, 9, 18, 10, 15]
	}];
	var option7 = {
		grid: {
			top: '6',
			right: '0',
			bottom: '17',
			left: '25',
		},
		xAxis: {
			data: ['1394', '1395', '1396', '1397', '1398', '1399'],
			axisLine: {
				lineStyle: {
					color: 'rgba(171, 167, 167,0.2)'
				}
			},
			axisLabel: {
				fontSize: 10,
				color: '#5f6d7a'
			}
		},
		tooltip: {
			trigger: 'axis',
			position: ['35%', '32%'],
		},
		yAxis: {
			splitLine: {
				lineStyle: {
					color: 'rgba(171, 167, 167,0.2)'
				}
			},
			axisLine: {
				lineStyle: {
					color: 'rgba(171, 167, 167,0.2)'
				}
			},
			axisLabel: {
				fontSize: 10,
				color: '#5f6d7a'
			}
		},
		series: chartdata4,
		color: ['#f7557a']
	};
	var chart7 = document.getElementById('echart7');
	var lineChart = echarts.init(chart7);
	lineChart.setOption(option7);


	/*----Echart8----*/
	var chartdata5 = [{
		name: ' اطلاعات ',
		type: 'line',
		smooth: true,
		data: [5, 15, 9, 18, 10, 15]
	}];
	var option8 = {
		grid: {
			top: '6',
			right: '0',
			bottom: '17',
			left: '25',
		},
		xAxis: {
			data: ['1394', '1395', '1396', '1397', '1398', '1399'],
			axisLine: {
				lineStyle: {
					color: 'rgba(171, 167, 167,0.2)'
				}
			},
			axisLabel: {
				fontSize: 10,
				color: '#5f6d7a'
			}
		},
		tooltip: {
			trigger: 'axis',
			position: ['35%', '32%'],
		},
		yAxis: {
			splitLine: {
				lineStyle: {
					color: 'rgba(171, 167, 167,0.2)'
				}
			},
			axisLine: {
				lineStyle: {
					color: 'rgba(171, 167, 167,0.2)'
				}
			},
			axisLabel: {
				fontSize: 10,
				color: '#5f6d7a'
			}
		},
		series: chartdata5,
		color: ['#285cf7']
	};
	var chart8 = document.getElementById('echart8');
	var lineChart2 = echarts.init(chart8);
	lineChart2.setOption(option8);


	/*----BarChartEchart----*/
	var echartBar = echarts.init(document.getElementById('index'), {
		color: ['#285cf7', '#f7557a'],
		categoryAxis: {
			axisLine: {
				lineStyle: {
					color: '#888180'
				}
			},
			splitLine: {
				lineStyle: {
					color: ['rgba(171, 167, 167,0.2)']
				}
			}
		},
		grid: {
			x: 40,
			y: 20,
			x2: 40,
			y2: 20
		},
		valueAxis: {
			axisLine: {
				lineStyle: {
					color: '#888180'
				}
			},
			splitArea: {
				show: true,
				areaStyle: {
					color: ['rgba(255,255,255,0.1)']
				}
			},
			splitLine: {
				lineStyle: {
					color: ['rgba(171, 167, 167,0.2)']
				}
			}
		},
	});
	echartBar.setOption({
		tooltip: {
			trigger: 'axis',
			position: ['35%', '32%'],
		},
		legend: {
			data: ['New Account', 'Expansion Account']
		},
		toolbox: {
			show: false
		},
		calculable: false,
		xAxis: [{
			type: 'category',
			data:  ['مهر', 'آبان', 'آذر', 'دی', 'بهمن', 'اسفند', 'فروردین', 'اردیبهشت', 'خرداد'],
			axisLine: {
				lineStyle: {
					color: 'rgba(171, 167, 167,0.2)'
				}
			},
			axisLabel: {
				fontSize: 10,
				color: '#5f6d7a'
			}
		}],
		yAxis: [{
			type: 'value',
			splitLine: {
				lineStyle: {
					color: 'rgba(171, 167, 167,0.2)'
				}
			},
			axisLine: {
				lineStyle: {
					color: 'rgba(171, 167, 167,0.2)'
				}
			},
			axisLabel: {
				fontSize: 10,
				color: '#5f6d7a'
			}
		}],
		series: [{
			name: '  نمایش قیمت ',
			type: 'bar',
			data:[2.0, 4.9, 7.0, 23.2, 25.6, 76.7, 135.6, 162.2, 32.6, 20.0, 6.4, 3.3],
			markPoint: {
				data: [{
					type: 'max',
					name: ''
				}, {
					type: 'min',
					name: ''
				}]
			},
			markLine: {
				data: [{
					type: 'average',
					name: ''
				}]
			}
		}, {
			name: ' قیمت خریداری شده ',
			type: 'bar',
			data:[2.6, 5.9, 9.0, 26.4, 28.7, 70.7, 175.6, 182.2, 48.7, 18.8, 6.0, 2.3],
			markPoint: {
				data: [{
					name: ' قیمت خریداری شده ',
					value: 182.2,
					xAxis: 7,
					yAxis: 183,
				}, {
					name: ' قیمت خریداری شده ',
					value: 2.3,
					xAxis: 11,
					yAxis: 3
				}]
			},
			markLine: {
				data: [{
					type: 'average',
					name: ''
				}]
			}
		}]
	});
});