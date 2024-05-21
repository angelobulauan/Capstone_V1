@extends('layouts.LOUser.app')
@section('content')


<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
<style>
body{

  background-color:#D9E5EE;
}
h1{
    font-family:Cambria, Cochin, Georgia, Times, 'Times New Roman', serif;
    font-weight: 800;
    font-size: 50px;
}
#mission
{
  margin: 20px;
  padding-top: 20px;
  padding-bottom: 20px;
}
.mission__container
{
  /* padding-top: 20px; */
  padding-bottom: 20px;
  padding-left: 20px;
  padding-right: 20px;
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(320px, 2fr));
  gap: 1rem;
}
.mission-vision
{
  background-color: #094F87;
  text-align: center;
  border: 1px solid transparent;
  border-radius: 20px;
  width: 100%;
}
.info
{
  padding: 2rem;
}
.info h1
{
  font-weight: bold;
  color:white;
  font-size: 40px;
}
.info p
{
  margin: 1.2rem 0 2rem;
  font-size: 1.2rem;
  color: #fff;
  font-style: italic;
  font-weight: 500;
  text-align: justify;
}
.moreText{
  display: none;
}
.read-more-btn{
  padding: 15px 60px;
  background-color: #E8AB53;
  color: black;
  border-radius: 20px;
  border: none;
  outline: none;
  font-size: 20px;
  cursor:pointer;
  font-weight: 500;
  font-family:cursive;
}
.read-more-btn:hover{
  background-color: white;
}
.text.show-more .moreText{
  display: inline;
}
.text.show-more .dots{
  display: none;
}
</style>
<body>
   
    <div class="container">
        <h1 class="Title text-center py-4">ARTICLE</h1>
       
<!-- 
        <div class="row">
            <div class="col-md-6 d-flex justify-content-center"> -->
        <section class="mission">
    <div class="mission__container">
      <article class="mission-vision">
        <div class="info">
          <h1>"Sea Secrets Unveiled: The Hidden Treasures of Seagrass Meadows"</h1> 
          <hr>
          <p class="text">Seagrasses play a vital role in marine ecosystems and provide numerous benefits to the environment. Here are some of the key importance of seagrasses:  <br> <br>
1. Habitat and Biodiversity: Seagrasses serve as essential habitats for a diverse range of marine species, including fish, invertebrates, and other marine organisms. They provide shelter, breeding grounds, and food sources for many marine animals, contributing to the overall biodiversity of coastal and marine <span class="dots">...</span> <span class="moreText">ecosystems. <br>
2. Carbon Sequestration: Seagrasses are highly efficient at capturing and storing carbon dioxide from the atmosphere through photosynthesis. They play a crucial role in carbon sequestration, helping to mitigate climate change by reducing the levels of greenhouse gases in the atmosphere. <br>
3. Coastal Protection: Seagrasses help stabilize coastlines and reduce coastal erosion by trapping sediments with their roots and rhizomes. They act as natural barriers against storm surges, protecting shorelines from erosion and minimizing the impact of waves and currents. <br>
4. Water Quality: Seagrasses improve water quality by trapping sediments and nutrients, thereby reducing turbidity and preventing algal blooms. They act as natural filters, helping to maintain the clarity and quality of coastal waters. <br>
5. Economic Importance: Seagrasses support important commercial and recreational fisheries by providing essential habitats for fish and shellfish. They contribute to the livelihoods of coastal communities through fishing, tourism, and other economic activities. <br>
6. Oxygen Production: Like terrestrial plants, seagrasses produce oxygen as a byproduct of photosynthesis. They contribute to the oxygenation of marine environments, supporting the health and survival of marine organisms. <br>
7. Nursery Grounds: Seagrasses are crucial nursery grounds for many marine species, including commercially important fish species. Juvenile fish and other marine organisms find shelter and food in seagrass beds, which are essential for their growth and survival. <br>
8. Erosion Control: Seagrasses help prevent coastal erosion by stabilizing sediments with their roots and rhizomes. They play a vital role in maintaining the integrity of coastal ecosystems and protecting shorelines from the impacts of waves and currents. <br> <br>
Overall, seagrasses are invaluable components of coastal and marine ecosystems, providing a wide range of ecological, economic, and social benefits. Protecting and conserving seagrass habitats is essential for the health and sustainability of marine environments worldwide. <br>
</span></p>
<button class="read-more-btn">Read More</button>
        </div>
      </article>
      </div>
      
        </div>
        <!-- <div class="col-md-6 d-flex justify-content-center">
        <section class="mission">
    <div class="mission__container">
      <article class="mission-vision">
        <div class="info">
          <h1>"Seagrass conservation solutions"</h1> 
          <hr>
          <p class="textt">Conserving seagrass habitats is crucial for maintaining the health and biodiversity of marine ecosystems. Here are some key solutions to help conserve seagrasses: <br> <br>
1. Reduce Pollution: Implement measures to reduce pollution from land-based sources, such as agricultural runoff, sewage discharge, and industrial pollutants. Controlling pollution helps maintain water quality and prevents the accumulation of nutrients and sediments that can harm seagrass beds. <br> 
2. Sustainable Coastal Development: Encourage sustainable coastal development practices<span class="dotss">...</span> <span class="moreeText"> that minimize habitat destruction and fragmentation. Avoid dredging, land reclamation, and construction activities that can damage seagrass habitats and disrupt ecosystem functions. <br>
3. Marine Protected Areas: Establish marine protected areas (MPAs) that include seagrass beds to provide legal protection and conservation measures for these important habitats. MPAs help restrict harmful activities and promote sustainable use of marine resources. <br>
4. Fisheries Management: Implement fisheries management practices that protect seagrass habitats and prevent overfishing of species that depend on seagrass ecosystems. Use sustainable fishing methods to minimize the impact on seagrass beds and associated marine life. <br>
5. Education and Awareness: Raise awareness about the importance of seagrasses and the threats they face among local communities, policymakers, and stakeholders. Promote education and outreach programs to engage the public in seagrass conservation efforts. <br>
6. Restoration Projects: Support seagrass restoration projects that aim to rehabilitate degraded or damaged seagrass habitats. These projects involve planting seagrass seeds or transplants in suitable areas to enhance seagrass recovery and resilience. <br>
7. Monitoring and Research: Conduct regular monitoring and research to assess the health and status of seagrass populations, identify threats, and track conservation efforts. Use scientific data to inform management decisions and conservation strategies. <br>
8. Collaboration and Partnerships: Foster collaboration among government agencies, non-profit organizations, research institutions, and local communities to work together on seagrass conservation initiatives. Partnerships can enhance conservation efforts and leverage resources for greater impact. <br>
9. Policy and Legislation: Advocate for the development and implementation of policies, laws, and regulations that protect seagrass habitats and promote sustainable management practices. Ensure compliance with existing environmental laws to safeguard seagrass ecosystems. <br> <br>
 
By implementing these solutions and engaging in collaborative conservation efforts, we can help preserve and protect seagrass habitats for future generations and ensure the continued health and resilience of marine ecosystems.
</span></p>
<button class="read-more-btn">Read More</button>
        </div>
      </article>
      </div> -->
      
        </div>
    </div>
   
</body>
<script>
  const readMoreBtn = document.querySelector('.read-more-btn');
  const text = document.querySelector('.text');

  readMoreBtn.addEventListener('click',(e)=>{
    text.classList.toggle('show-more');
    if(readMoreBtn.innerText === 'Read More'){
      readMoreBtn.innerText = 'Read Less';
    }else{
      readMoreBtn.innerText = 'Read More';
    }
  })
  
</script>
    @endsection 