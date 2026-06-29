@extends('front.layouts.app')

@section('content')
    <div class="section position-relative"
        style="background-image: url(assets/image/image-1920x900-10.jpg); height: 70vh; background-position: top;">
        <div class="image-overlay"></div>
        <div class="r-container h-100 position-relative" style="z-index: 2;">
            <div class="d-flex flex-column w-100 h-100 justify-content-center align-items-center mx-auto text-center text-white gap-3"
                style="max-width: 895px;">
                <h1 class="font-1 m-0"><?php echo $title; ?></h1>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page"><?php echo $title; ?></li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    <!--
                  ============================
                  Contact Info Section
                  ============================
                  -->
    <div class="section">
        <div class="r-container">
            <div class="d-flex flex-lg-row flex-column-reverse gap-5">
                <div class="col">
                    <div class="d-flex flex-column">
                        <div class="p-5 w-100 bg-white shadow rounded-3">
                            <div class="d-flex flex-column gap-3 p-lg-4">
                                <div>
                                    <form class="contactForm" method="post" action="{{ route('contact.submit') }}">
                                        @csrf
                                        <div class="mb-3">
                                            <label for="name" class="form-label">Name *</label>
                                            <input class="form-control" type="text" name="contact-name"
                                                placeholder="Name" required="" />
                                        </div>
                                        <div class="mb-3">
                                            <label for="email" class="form-label">Email *</label>
                                            <input class="form-control" type="text" name="contact-email"
                                                placeholder="Email" required="" />
                                        </div>

                                        <div class="row row-cols-2">
                                            <div class="col mb-3">
                                                <label for="phone" class="form-label">Phone *</label>
                                                <input class="form-control py-3 px-4" type="text" name="contact-phone"
                                                    placeholder="Phone" required="" />
                                            </div>
                                            <div class="col mb-3">
                                                <label for="service" class="form-label">Services *</label>
                                                <select name="service" id="service" class="form-control py-3 px-4" required>
                                                    <option disabled selected>Select Service</option>
                                                    <option value="Improve Test Taking Ability">Improve Test Taking Ability
                                                    </option>
                                                    <option value="Pain Modification">Pain Modification</option>
                                                    <option value="Anxiety or Depression">Anxiety or Depression</option>
                                                    <option value="Low Self-Esteem">Low Self-Esteem</option>
                                                    <option value="Migraine and Tension Headaches">Migraine and Tension
                                                        Headaches</option>
                                                    <option value="Phobias or Other Fears">Phobias or Other Fears</option>
                                                    <option value="Stress Management">Stress Management</option>
                                                    <option value="Sports Improvement">Sports Improvement</option>
                                                    <option value="Weight Control">Weight Control</option>
                                                    <option value="Sleep Disorders">Sleep Disorders</option>
                                                    <option value="Relationships">Relationships</option>
                                                    <option value="Prosperity">Prosperity</option>
                                                    <option value="Refresh Memory">Refresh Memory</option>
                                                    <option value="Alcohol and Drug Abuse Recovery">Alcohol and Drug Abuse
                                                        Recovery</option>
                                                    <option value="Smoking Cessation">Smoking Cessation</option>
                                                    <option value="Past Life Regression Therapy">Past Life Regression
                                                        Therapy</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="mb-3">
                                            <label for="details" class="form-label">Details *</label>
                                            <textarea class="form-control" name="contact-message" cols="30" rows="2" placeholder="message"
                                                required=""></textarea>
                                        </div>

                                  
                                        <div class="mb-3">
                                            <label class="form-label">When is the best time to contact you *</label>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="Morning" id="morning" name="contact_time[]">
                                                <label class="form-check-label" for="morning">
                                                    Morning
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="Afternoon" id="afternoon" name="contact_time[]">
                                                <label class="form-check-label" for="afternoon">
                                                    Afternoon
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="Evening" id="evening" name="contact_time[]">
                                                <label class="form-check-label" for="evening">
                                                    Evening
                                                </label>
                                            </div>
                                        </div>


                                        <button type="submit"
                                            class="btn btn-accent submit_appointment justify-content-center py-3">
                                            Book Appointment
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="d-flex flex-column gap-3 h-100 justify-content-center">
                        <span class="fw-semibold">Contact Us</span>
                        <h3 class="font-1 fw-semibold">Send Us a Message</h3>
                        <p class="text-gray">
                            Curabitur quis diam malesuada sem porta mollis. Ut vel tortor in neque sollicitudin
                            feugiat a ac ex. Etiam eleifend orci eget tempus rhoncus. Nunc ligula erat, elementum eu
                            augue at, pharetra iaculis leo.
                        </p>
                        <ul class="list gap-3 text-black mb-4">
                            <li>
                                <a href="https://www.google.co.in/maps/place/822+E+McLellan+Blvd,+Phoenix,+AZ+85014,+USA/@33.5330344,-112.0644535,17z/data=!3m1!4b1!4m6!3m5!1s0x872b6d4d1a18c517:0x46fd56526f5e71c4!8m2!3d33.53303!4d-112.0618786!16s%2Fg%2F11c16m0xj3?entry=ttu&g_ep=EgoyMDI1MDMxMC4wIKXMDSoASAFQAw%3D%3D"
                                    target="_blank">
                                    <span class="d-flex flex-row align-items-center gap-3">
                                        <i class="fa-solid fa-location-dot"></i>
                                        822 E McLellan Blvd, Phoenix, AZ 85014, United States
                                    </span>
                                </a>
                            </li>
                            <li>
                                <a href="tel:602-301-6551">
                                    <span class="d-flex flex-row align-items-center gap-3">
                                        <i class="fa-solid fa-phone"></i>
                                        602-301-6551
                                    </span>
                                </a>
                            </li>
                            <li>
                                <a href="mailto:dc@nowvoyagerhypnotherapy.com" class="text-lowercase">
                                    <span class="d-flex flex-row align-items-center gap-3">
                                        <i class="fa-solid fa-envelope"></i>
                                        dc@nowvoyagerhypnotherapy.com
                                    </span>
                                </a>
                            </li>
                        </ul>
                        <div class="d-flex flex-column gap-3">
                            <h5 class="font-1">Follow Us :</h5>
                            <div class="social-container accent mb-lg-0 mb-3">
                                <a href="https://www.facebook.com/nowvoyagerhypnotherapy?fref=ts" target="_blank"
                                    class="social-item">
                                    <i class="fa-brands fa-facebook-f"></i>
                                </a>
                                <a href="https://www.youtube.com/user/NowVoyagerHypnosis" target="_blank"
                                    class="social-item">
                                    <i class="fa-brands fa-youtube"></i>
                                </a>
                                <a href="https://www.linkedin.com/in/nowvoyagerhypnotherapy" target="_blank"
                                    class="social-item">
                                    <i class="fa-brands fa-linkedin"></i>
                                </a>
                                <a href="https://www.google.com/search?q=Now+boyager+counselling+Hypnosis%2C+phoenix+az&sca_esv=557795853e6eaba1&ei=6XbQZ6HpEOKMseMPkdKI2AM&ved=0ahUKEwjhgcTTyoKMAxViRmwGHREpAjsQ4dUDCBA&uact=5&oq=Now+boyager+counselling+Hypnosis%2C+phoenix+az&gs_lp=Egxnd3Mtd2l6LXNlcnAiLE5vdyBib3lhZ2VyIGNvdW5zZWxsaW5nIEh5cG5vc2lzLCBwaG9lbml4IGF6MgcQIRigARgKSKdOUABYqk1wAHgAkAEAmAHtAaABmTeqAQYwLjQyLjG4AQPIAQD4AQGYAiugArk4wgILEAAYgAQYkQIYigXCAhEQLhiABBixAxjRAxiDARjHAcICCxAAGIAEGLEDGIMBwgIUEC4YgAQYsQMY0QMYgwEYxwEYigXCAg4QABiABBixAxiDARiKBcICCxAuGIAEGJECGIoFwgIKEC4YgAQYQxiKBcICEBAuGIAEGNEDGEMYxwEYigXCAhAQLhiABBixAxhDGNQCGIoFwgILEC4YgAQYsQMY5QTCAg4QLhiABBixAxiDARjlBMICGhAuGIAEGJECGIoFGJcFGNwEGN4EGOAE2AEBwgIQEAAYgAQYsQMYQxiDARiKBcICDRAAGIAEGLEDGEMYigXCAgoQABiABBhDGIoFwgINEC4YgAQYsQMYQxiKBcICEBAuGIAEGLEDGEMYgwEYigXCAggQABiABBixA8ICIhAuGIAEGEMYigUYlwUY3AQY3gQY4AQY9AMY8QMY9QPYAQHCAgsQLhiABBjHARivAcICBRAAGIAEwgIaEC4YgAQYxwEYrwEYlwUY3AQY3gQY4ATYAQHCAgUQLhiABMICCBAuGIAEGOUEwgIHEC4YgAQYCsICBxAAGIAEGArCAiIQLhiABBgKGJcFGNwEGN4EGOAEGPQDGPEDGPUDGPYD2AEBwgIHEAAYgAQYDcICBhAAGBYYHsICCBAAGAgYDRgewgIGECEYFRgKwgIEECEYCsICBRAhGKABwgIEECEYFZgDALoGBggBEAEYFJIHBjAuNDIuMaAH5MAC&sclient=gws-wiz-serp"
                                    target="_blank" class="social-item">
                                    <i class="fa-brands fa-google"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="section p-0">
        <iframe loading="lazy" class="maps overflow-hidden"
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3231.332129286469!2d-112.0644535!3d33.5330344!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x872b6d4d1a18c517%3A0x46fd56526f5e71c4!2s822+E+McLellan+Blvd%2C+Phoenix%2C+AZ+85014%2C+USA!5e0!3m2!1sen!2sin!4v1678508329625!5m2!1sen!2sin"
            title="London Eye, London, United Kingdom" aria-label="London Eye, London, United Kingdom"></iframe>
    </div>

    <!--
                  ============================
                  Google Maps Section
                  ============================
                  -->
                  <div class="section p-0">
                    <iframe loading="lazy" class="maps overflow-hidden"
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3231.332129286469!2d-112.0644535!3d33.5330344!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x872b6d4d1a18c517%3A0x46fd56526f5e71c4!2s822+E+McLellan+Blvd%2C+Phoenix%2C+AZ+85014%2C+USA!5e0!3m2!1sen!2sin!4v1678508329625!5m2!1sen!2sin"
                        title="London Eye, London, United Kingdom" aria-label="London Eye, London, United Kingdom"></iframe>
                </div>
@endsection
