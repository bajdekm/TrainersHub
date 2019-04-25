<template>
    <div>
        <div class="card-group">
            <div class="card">
                <div class="card-body">
                    <vue-cal style="height: 700px" class="vuecal--green-theme"
                             :disable-views="['years', 'year', 'month']"
                             :time-from="8 * 60" :time-to="22 * 60" :time-step="60"
                             locale='pl' :events="events"
                             @event-mouse-enter="logEvents('event-mouse-enter', $event)"
                             :on-event-click="onEventClick">
                    </vue-cal>
                </div>
            </div>
        </div>

        <div v-if="showLookup" class="modal fade" id="lookupModal" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>{{ selectedEvent.icon }}</p>
                        <p>{{ selectedEvent.title }}</p>
                        <p>{{ selectedEvent.startDate }}</p>
                        <p v-html="selectedEvent.contentFull"/>
                        <strong>Event details:</strong>
                        <ul>
                            <li>Event starts at: {{ selectedEvent.startTime }}</li>
                            <li>Event ends at: {{ selectedEvent.endTime }}</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <p class="m-1">&nbsp;</p>
    </div>
</template>

<script>
    import 'vue-cal/dist/vuecal.css'

    export default {
        data: () => ({
            selectedEvent: {},
            showDialog: false,
            showLookup: false,
            events: [
                {
                    start: '2019-04-10 10:00',
                    end: '2019-04-10 11:00',
                    title: '10:00-11:00',
                    icon: 'shopping_cart', // Custom field.
                    content: '10:00-11:00',
                    contentFull: 'll', // Custom field.
                    class: 'leisure'
                },
                {
                    start: '2019-04-10 11:00',
                    end: '2019-04-10 12:00',
                    title: '11:00-12:00',
                    icon: 'shopping_cart', // Custom field.
                    content: '11:00-12:00',
                    // contentFull: '', // Custom field.
                    class: 'leisure'
                },
                {
                    start: '2019-04-11 10:00',
                    end: '2019-04-11 11:00',
                    title: '10:00-11:00',
                    icon: 'shopping_cart', // Custom field.
                    content: '10:00-11:00',
                    contentFull: 'll', // Custom field.
                    class: 'leisure'
                },
                {
                    start: '2019-04-11 11:00',
                    end: '2019-04-11 12:00',
                    title: '11:00-12:00',
                    icon: 'shopping_cart', // Custom field.
                    content: '11:00-12:00',
                    // contentFull: '', // Custom field.
                    class: 'leisure'
                },
                {
                    start: '2019-04-12 10:00',
                    end: '2019-04-12 11:00',
                    title: 'Golf with John',
                    icon: 'golf_course', // Custom field.
                    content: '<strong style="color: red">Do I need to tell how many holes?</strong>',
                    content: 'Do I need to tell how many holes?',
                    contentFull: 'Okay.<br>It will be a 18 hole golf course.', // Custom field.
                    class: 'sport'
                },
                {
                    start: '2019-04-13 12:00',
                    end: '2019-04-13 14:00',
                    title: 'LUNCH',
                    class: 'lunch',
                    background: true
                },
                {
                    start: '2019-04-06 12:00',
                    end: '2019-04-06 14:00',
                    title: 'LUNCH',
                    class: 'lunch',
                    background: true
                },
            ]
        }),
        methods:{
            onEventClick (event, e) {
                console.log('onEventClick');
                this.selectedEvent = event;
                this.showLookup = true;

                setTimeout(() => {
                    $('#lookupModal').modal('show');
                }, 350);
                // Prevent navigating to narrower view (default vue-cal behavior).
                e.stopPropagation()
            },
            logEvents($event,e){
                // console.log('event focuse: ',$event);
                // console.log('event focuse: ',e);
            }
        },
        created: function created() {
            console.log('** Welcome created: '+this._uid);
            // this.events = new Array();

        }
    }
</script>

<style>

    .vuecal__event.leisure {
        cursor: pointer;
        background:rgba(255,255,255, 0.01);
        /*background-color: white;*/
        /*border: 2px solid black;*/
        /*background-color: rgba(82, 174, 250, 0.2);*/
        color: black;
        align-items: center;
        justify-content: center;
    }

    .vuecal__event.leisure .vuecal__event-content {
        margin-top: 8px;
        border-top: 1px solid black;
        border-bottom: 1px solid black;
        font-weight: bold;
        weight: 80%;
    }
    .vuecal__event.leisure .vuecal__event-content:hover {
        margin-top: 8px;
        border: 1px solid black;
        font-weight: bold;
        background-color: rgba(66, 185, 131, 0.8);
        /*text-decoration:line-through;*/
    }

    .vuecal__event-title {
        display: none;
        font-weight: bold;
        margin-top: 8px;
        border: 1px solid black;
        /*background-color: rgba(82, 174, 250, 0.2);*/

    }

    .vuecal__event-time {
        display: none;
        text-align: center;
        justify-content: center;
        align-items: center;
        /*margin-bottom: 12px;*/
        /*padding-top: 10px;*/
        /*border: 5px solid white;*/
    }

    .vuecal__event-content {
        font-style: italic;
        /*color: red;*/
        /*background-color: #6cb2eb;*/
    }
    .vuecal__event.lunch {
        background: repeating-linear-gradient(45deg, transparent, transparent 10px, #f2f2f2 10px, #f2f2f2 20px);/* IE 10+ */
        color: #999;
        display: flex;
        justify-content: center;
        align-items: center;
    }
    .vuecal__event.lunch .vuecal__event-time {display: none;align-items: center;}

</style>
