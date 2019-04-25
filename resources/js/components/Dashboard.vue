<template>
    <div id="infocontainer">
        <SystemInfo/>

    </div>
</template>

<script>
    import SystemInfo from "./admin-panel/SystemInfo";
    export default {
        name: "Dashboard",
        components: { SystemInfo}
    }
</script>

<style scoped>
    #infocontainer {
        padding-top: 10px;
    }

</style>
