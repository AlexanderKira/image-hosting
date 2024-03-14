<div>
    <form action="{{ route('page.home') }}" method="GET">
        <div class="input-group input-daterange mb-3">
            <input type="text" class="form-control" placeholder="Название изображения" aria-label="Recipient's username" aria-describedby="button-addon2" id="title" name="title"/>
            <input class="btn btn-outline-secondary" type="submit" id="button-addon2" value="Найти">
            <div class="input-group input-daterange">
                <input type="datetime-local" class="form-control" id="startDate" name="start_date" value="от">
                <input type="datetime-local" class="form-control" id="endDate" name="end_date" value="до">
            </div>
        </div>
    </form>
</div>
