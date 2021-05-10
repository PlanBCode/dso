    <div class="modal fade" id="voteModal" tabindex="-1" aria-labelledby="voteModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-scrollable">
            <div class="modal-content bg-gray-200">
                <div class="modal-header">
                    <h5 class="modal-title" id="voteModalLabel">Sla mijn keuze op en verstuur</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body bg-white">
                    <div data-vote-section style="display: none;">
                        <div class="sm:justify-start mb-3">
                            <p>
                            Dit is het onderwerp waarop je gaat stemmen:<br>
                            <strong data-display-vote-title></strong>
                            </p>
                        </div>
                        <div class="sm:justify-start mb-3">
                            Je kunt per stemronde op één onderwerp stemmen.<br>
                            <label for="importance">
                                Waarom vind je het belangrijk dat de Stadsbron dit onderwerp onderzoekt?
                                <textarea type="text" name="importance" id="importance" rows="8" class="form-control"></textarea>
                            </label>
                        </div>
                    </div>
                    <div data-help-section style="display: none;">
                        <div class="sm:justify-start mb-3">
                            Dit zijn de onderwerpen die je wil meehelpen onderzoeken:
                            <div data-display-help-titles></div>
                        </div>
                        <div class="sm:justify-start mb-3">
                            Heb je al een idee hoe je wil meehelpen als dit de Stadsbron dit onderwerp gaat onderzoeken?<br>
                            Ben je bijvoorbeeld goed in jaarverslagen lezen, vind je het leuk om teksten te redigeren<br>
                            of iets heel anders? Je kunt per onderwerp aangeven hoe je wil helpen.<br>
                            <label for="assist">
                                <textarea type="text" name="assist" id="assist" rows="8" class="form-control"></textarea>
                            </label>
                        </div>
                        <div class="sm:justify-start mb-3">
                            Mogen we ook contact met je opnemen om mee te helpen als een ander onderwerp de meeste stemmen krijgt?<br>
                            <label for="contact_yes" class="d-inline pr-3"><input type="radio" name="contact" id="contact_yes" value="yes"> Ja, dat mag</label> <label for="contact_no" class="d-inline pr-3"><input type="radio" name="contact" id="contact_no" value="no"> Nee, liever niet</label><br>
                        </div>
                    </div>
                    <div class="sm:justify-start mb-3">
                        Vul tot slot hieronder je e-mailadres in. Zo kunnen we je op de hoogte houden over het onderzoek.<br>
                        Je ontvangt een mail van ons met daarin een bevestigingslink.
                        <label for="email">
                            E-mailadres *<br>
                            <input type="email" name="email" id="email" class="form-control" required>
                            <div class="invalid-feedback">
                                Dit veld is verplicht.
                            </div>
                        </label>
                    </div>
                    <div class="pt-8 sm:justify-start">
                        <label for="agree">
                            <input type="checkbox" name="agree_to_terms" id="agree" required> Ik ga ermee akkoord dat mijn contactgegevens gebruikt worden om me op de hoogte te houden over de Stadsbron Onderzoekt. Mijn gegevens worden nergens anders dan voor dit doel gebruikt en niet met derden gedeeld. *<br>
                            <div class="invalid-feedback">
                                Dit veld is verplicht.
                            </div>
                        </label>
                    </div>
                </div>
                <div class="modal-footer modal-footer__with-content">
                    <button type="submit" class="btn btn-primary">Sla op en verstuur</button>
                </div>
            </div>
        </div>
    </div>
