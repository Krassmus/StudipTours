<ol id="studip_tour" style="display: none;">
    <li data-id="nav_community__blubber" data-button="<?= dgettext("tour", "weiter") ?>">
        <?= dgettext("tour", "Willkommen im globalen Blubberstream! Hier siehst Du alle Blubber Deiner Buddies, Deiner Gruppen/Veranstaltungen und alle privaten Blubber.") ?>
        <br><br>
        <?= dgettext("tour", "Was sind Blubber? Das ist eine Mischung aus Posting und Chatnachricht. Hier im globalen Stream vereint sich alles, was Dich interessieren könnte.") ?>
        <br><br>
        <?= dgettext("tour", "Ist noch leer hier, wird aber gleich voller.") ?>
        <br><br>
    </li>
    <li data-id="new_posting" data-button="<?= dgettext("tour", "Okay, ich tippe was ...") ?>" data-options="tipLocation:top;pauseAfter:[1]">
        <?= dgettext("tour", "Starte Dein neues Leben in der Blubbersphäre mit einem kleinen öffentlichen Posting, in dem Du Dich ganz ganz kurz vorstellst, das aber auf jeden Fall die Zeichenfolge <code>#neuhier</code> beinhaltet.") ?>
        <br><br>
        <?= dgettext("tour", "Wenn Du fertig getippt hast, drücke einfach Enter und wähle \"öffentlich\" als Kontext aus.") ?>
        <br><br>
    </li>
</ol>

<? if (GetNumberOfBuddies() < 2 && !$GLOBALS['perm']->have_perm("admin")) : ?>
<ol id="studip_tour_first_posting" style="display: none;">
    <li data-class="thread" data-button="<?= dgettext("tour", "Okay, aber wie?") ?>">
        <?= dgettext("tour", "Sehr cool! Arbeiten wir mal weiter daran, dass sich Dein Stream füllt. Du solltest einige Leute finden, die Deine Buddies sind. Wir hoffen jetzt mal, dass es in diesem System so Leute gibt, die da in Frage kommen.") ?>
        <br><br>
    </li>
    <li data-id="nav_community__contacts" data-button="Alles klar, wird gemacht.">
        <?= dgettext("tour", "Suche unter \"Kontakte\" nach Personen, die Du kennst und füge sie als Kontakt/Buddy hinzu. Sodann wirst Du deren öffentliche Blubber in Deinem Blubberstream sehen.") ?>
        <br><br>
    </li>
</ol>

<script>
window.setInterval(function () {
    if (jQuery("#forum_threads.globalstream > li.thread[data-autor='" + jQuery("#user_id").val() + "']").length === 1
            && jQuery(".joyride-tip-guide:visible").length === 0
            && !jQuery("#forum_threads").hasClass("tour_done")) {
        STUDIP.tours.start("studip_tour_first_posting");
        jQuery("#forum_threads").addClass("tour_done");
    }
}, 2000);
</script>
<? endif ?>