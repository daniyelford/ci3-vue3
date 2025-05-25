$(function() {
	'use strict';
	var morrisData = [{
		y: '1392',
		a: 100,
		b: 90
	}, {
		y: '1393',
		a: 75,
		b: 65
	}, {
		y: '1394',
		a: 50,
		b: 40
	}, {
		y: '1395',
		a: 75,
		b: 65
	}, {
		y: '1396',
		a: 50,
		b: 40
	}, {
		y: '1397',
		a: 80,
		b: 90
	}, {
		y: '1398',
		a: 75,
		b: 65
	}, {
		y: '1399',
		a: 50,
		b: 70
	}];
	var morrisData2 = [{
		y: '1392',
		a: 100,
		b: 90,
		c: 80
	}, {
		y: '1393',
		a: 75,
		b: 65,
		c: 75
	}, {
		y: '1394',
		a: 50,
		b: 40,
		c: 45
	}, {
		y: '1395',
		a: 75,
		b: 65,
		c: 85
	}, {
		y: '1396',
		a: 100,
		b: 90,
		c: 80
	}, {
		y: '1397',
		a: 75,
		b: 65,
		c: 75
	}, {
		y: '1398',
		a: 50,
		b: 40,
		c: 45
	}, {
		y: '1399',
		a: 75,
		b: 65,
		c: 85
	}];
	new Morris.Bar({
		element: 'morrisBar1',
		data: morrisData,
		xkey: 'y',
		ykeys: ['a', 'b'],
		labels: ['سری A', 'سری B'],
		barColors: ['#6d6ef3', '#285cf7'],
		gridTextSize: 11,
		hideHover: 'auto',
		resize: true
	});
	new Morris.Bar({
		element: 'morrisBar2',
		data: morrisData2,
		xkey: 'y',
		ykeys: ['a', 'b', 'c'],
		labels: ['سری A', 'سری B', 'سری C'],
		barColors: ['#6d6ef3', '#285cf7', '#f7557a'],
		gridTextSize: 11,
		hideHover: 'auto',
		resize: true
	});
	new Morris.Bar({
		element: 'morrisBar3',
		data: morrisData,
		xkey: 'y',
		ykeys: ['a', 'b'],
		labels: ['سری A', 'سری B'],
		barColors: ['#6d6ef3', '#285cf7'],
		stacked: true,
		gridTextSize: 11,
		hideHover: 'auto',
		resize: true
	});
	new Morris.Bar({
		element: 'morrisBar4',
		data: morrisData2,
		xkey: 'y',
		ykeys: ['a', 'b', 'c'],
		labels: ['سری A', 'سری B', 'سری C'],
		barColors: ['#6d6ef3', '#285cf7', '#f7557a'],
		stacked: true,
		gridTextSize: 11,
		hideHover: 'auto',
		resize: true
	});
	new Morris.Line({
		element: 'morrisLine1',
		data: [{
			y: '1392',
			a: 20,
			b: 10
		}, {
			y: '1393',
			a: 30,
			b: 15
		}, {
			y: '1394',
			a: 60,
			b: 40
		}, {
			y: '1395',
			a: 40,
			b: 25
		}, {
			y: '1396',
			a: 30,
			b: 15
		}, {
			y: '1397',
			a: 45,
			b: 20
		}, {
			y: '1398',
			a: 60,
			b: 40
		}],
		xkey: 'y',
		ykeys: ['a', 'b'],
		labels: ['سری A', 'سری B'],
		lineColors: ['#6d6ef3', '#285cf7'],
		lineWidth: 1,
		ymax: 'auto 100',
		gridTextSize: 11,
		hideHover: 'auto',
		resize: true
	});
	new Morris.Line({
		element: 'morrisLine2',
		data: [{
			y: '1392',
			a: 20,
			b: 10,
			c: 40
		}, {
			y: '1393',
			a: 30,
			b: 15,
			c: 45
		}, {
			y: '1394',
			a: 50,
			b: 40,
			c: 65
		}, {
			y: '1395',
			a: 40,
			b: 25,
			c: 55
		}, {
			y: '1396',
			a: 30,
			b: 15,
			c: 45
		}, {
			y: '1397',
			a: 45,
			b: 20,
			c: 65
		}, {
			y: '1398',
			a: 60,
			b: 40,
			c: 70
		}],
		xkey: 'y',
		ykeys: ['a', 'b', 'c'],
		labels: ['سری A', 'سری B', 'سری C'],
		lineColors: ['#6d6ef3', '#285cf7', '#f7557a'],
		lineWidth: 1,
		ymax: 'auto 100',
		gridTextSize: 11,
		hideHover: 'auto',
		resize: true
	});
	new Morris.Area({
		element: 'morrisArea1',
		data: [{
			y: '1392',
			a: 50,
			b: 40
		}, {
			y: '1393',
			a: 25,
			b: 15
		}, {
			y: '1394',
			a: 20,
			b: 40
		}, {
			y: '1395',
			a: 75,
			b: 65
		}, {
			y: '1396',
			a: 50,
			b: 40
		}, {
			y: '1397',
			a: 75,
			b: 65
		}, {
			y: '1398',
			a: 100,
			b: 90
		}],
		xkey: 'y',
		ykeys: ['a', 'b'],
		labels: ['سری A', 'سری B'],
		lineColors: ['#6d6ef3', '#285cf7'],
		lineWidth: 1,
		fillOpacity: 0.9,
		gridTextSize: 11,
		hideHover: 'auto',
		resize: true
	});
	new Morris.Area({
		element: 'morrisArea2',
		data: [{
			y: '1392',
			a: 20,
			b: 10,
			c: 40
		}, {
			y: '1393',
			a: 30,
			b: 15,
			c: 45
		}, {
			y: '1394',
			a: 50,
			b: 40,
			c: 65
		}, {
			y: '1395',
			a: 40,
			b: 25,
			c: 55
		}, {
			y: '1396',
			a: 30,
			b: 15,
			c: 45
		}, {
			y: '1397',
			a: 45,
			b: 20,
			c: 65
		}, {
			y: '1398',
			a: 60,
			b: 40,
			c: 70
		}],
		xkey: 'y',
		ykeys: ['a', 'b', 'c'],
		labels: ['سری A', 'سری B', 'سری C'],
		lineColors: ['#6d6ef3', '#285cf7', '#f7557a'],
		lineWidth: 1,
		fillOpacity: 0.9,
		gridTextSize: 11,
		hideHover: 'auto',
		resize: true
	});
	new Morris.Donut({
		element: 'morrisDonut1',
		data: [{
			label: 'آقا',
			value: 12
		}, {
			label: 'خانم',
			value: 30
		}, {
			label: 'بچه ها',
			value: 20
		}],
		colors: ['#6d6ef3', '#285cf7', '#f7557a'],
		resize: true,
		labelColor:"#8c9fc3"
	});
	
	new Morris.Donut({
		element: 'morrisDonut2',
		data: [{
			label: 'آقا',
			value: 12
		}, {
			label: 'خانم',
			value: 30
		}, {
			label: 'بچه ها',
			value: 20
		}, {
			label: 'نوزاد',
			value: 25
		}],
		colors: ['#6d6ef3', '#285cf7', '#f7557a', '#74DE00'],
		resize: true,
		labelColor:"#8c9fc3"
		
	});
});