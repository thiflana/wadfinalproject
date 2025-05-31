<x-app-layout>
    <head>
        <link rel="stylesheet" href="{{ asset('css/loginregister.css') }}">
        <style>

            .dashbg{
                background-color: #FDF5E6;
            }
            .image-side {
                background-size: cover;
                height: 100vh;
                width: 100%;
                display: flex;
                flex-direction: column;
                padding-top: 20px;
                overflow: hidden;
            }
            .section-container {
                display: flex;
                flex-direction: column;
                gap: 20px; /* Space between sections */
                width: 90%;
                max-width: 1000px;
                margin: auto;
            }
            .scroll-container {
                display: flex;
                overflow-x: auto;
                gap: 10px;
                padding: 10px;
                white-space: nowrap;
                scrollbar-width: none;
                scroll-behavior: smooth;
            }
            .scroll-container::-webkit-scrollbar {
                display: none;
            }
            .card {
                width: 120px; /* Smaller card */
                height: 120px;
                background-color: #A6F6C3;
                display: flex;
                align-items: center;
                justify-content: center;
                font-size: 18px;
                font-weight: bold;
                color: white;
                border-radius: 8px;
                flex-shrink: 0;
                box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
                border: 2px solid #FF6B6B; /* Blue border */
            }
            .section-button {
                margin-top: 10px;
                padding: 10px 15px;
                background-color: #3b82f6;
                color: white;
                border: none;
                border-radius: 5px;
                cursor: pointer;
                font-size: 16px;
            }
        </style>
    </head>

    <div class="py-0 dashbg">
        <div class="max-w-7xl mx-auto sm:px-0 lg:px-0">

                    <!-- Section 1 -->
                    <div class="section-container">
                        <div class="scroll-container" id="section1">
                            <div class="card">1</div>
                            <div class="card">2</div>
                            <div class="card">3</div>
                        </div>
                        <button class="section-button" onclick="addCard('section1')">Add to Section 1</button>
                    </div>

                    <!-- Section 2 -->
                    <div class="section-container">
                        <div class="scroll-container" id="section2">
                            <div class="card">4</div>
                            <div class="card">5</div>
                            <div class="card">6</div>
                        </div>
                        <button class="section-button" onclick="addCard('section2')">Add to Section 2</button>
                    </div>

                    <!-- Section 3 -->
                    <div class="section-container">
                        <div class="scroll-container" id="section3">
                            <div class="card">7</div>
                            <div class="card">8</div>
                            <div class="card">9</div>
                        </div>
                        <button class="section-button" onclick="addCard('section3')">Add to Section 3</button>
                    </div>

        </div>
    </div>

    <script>
        function addCard(sectionId) {
            const section = document.getElementById(sectionId);
            const newCard = document.createElement("div");
            newCard.classList.add("card");
            newCard.textContent = section.children.length + 1; // Assigning card number

            section.appendChild(newCard);
            section.scrollLeft += 140; // Auto-scrolls to new card
        }
    </script>

</x-app-layout>
