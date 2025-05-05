document.addEventListener('DOMContentLoaded', function() {
	var initialLocaleCode = 'fa';
	var localeSelectorEl = document.getElementById('locale-selector');
	var calendarEl = document.getElementById('calendar');
  
	var calendar = new FullCalendar.Calendar(calendarEl, {
	  headerToolbar: {
		left: 'prev,next today',
		center: 'title',
		right: 'dayGridMonth,timeGridWeek,timeGridDay,listMonth'
	  },
	  initialDate: '2020-06-12',
	  locale: initialLocaleCode,
	  buttonIcons: false, // show the prev/next text
	  weekNumbers: true,
	  navLinks: true, // can click day/week names to navigate views
	  editable: true,
	  dayMaxEvents: true, // allow "more" link when too many events
	  events: [
		{
		  title: 'رویداد یک روز کامل',
		  start: '2020-06-01'
		},
		{
		  title: 'رویداد طولانی',
		  start: '2020-06-07',
		  end: '2020-06-10',
		  backgroundColor: "#f356d9"
		},
		{
		  groupId: 999,
		  title: 'تکرار رویداد',
		  start: '2020-06-09T16:00:00',
		  backgroundColor: "#ffab03"
		},
		{
		  groupId: 999,
		  title: 'تکرار رویداد',
		  start: '2020-06-16T16:00:00',
		  backgroundColor: "#0573f0"
		},
		{
		  title: 'کنفرانس',
		  start: '2020-06-11',
		  end: '2020-06-13'
		},
		{
		  title: 'ملاقات',
		  start: '2020-06-12T10:30:00',
		  end: '2020-06-12T12:30:00',
		  backgroundColor: "#9b59b6"
		},
		{
		  title: 'ناهار',
		  start: '2020-06-12T12:00:00',
		  backgroundColor: "#0573f0",
		},
		{
		  title: 'ملاقات',
		  start: '2020-06-12T14:30:00',
		  backgroundColor: "#46be76",
		},
		{
		  title: 'ساعات خوش',
		  start: '2020-06-12T17:30:00',
		  backgroundColor: "#0573f0"
		},
		{
		  title: 'شام',
		  start: '2020-06-12T20:00:00',
		  backgroundColor: "#f356d9"
		},
		{
		  title: 'مهمانی تولد',
		  start: '2020-06-28 T07:00:00',
		  backgroundColor: "#ffab03"
		},
		{
		  title: 'گوگل',
		  url: 'http://google.com/',
		  start: '2020-06-28',
		  backgroundColor: "#46be76"
		}
	  ]
	});
  
	calendar.render();
  
	// build the locale selector's options
	calendar.getAvailableLocaleCodes().forEach(function(localeCode) {
	  var optionEl = document.createElement('option');
	  optionEl.value = localeCode;
	  optionEl.selected = localeCode == initialLocaleCode;
	  optionEl.innerText = localeCode;
	  localeSelectorEl.appendChild(optionEl);
	});
  
	// when the selected option changes, dynamically change the calendar option
	localeSelectorEl.addEventListener('change', function() {
	  if (this.value) {
		calendar.setOption('locale', this.value);
	  }
	});
  
  });
  