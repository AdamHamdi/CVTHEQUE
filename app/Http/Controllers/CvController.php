<?php

namespace App\Http\Controllers;
use App\Http\Requests\cvRequest;
use Illuminate\Http\Request;
use App\Cv;
use App\Experience;
use App\Traning;
use App\Skill;
use App\Project;
use Illuminate\http\UploadedFile;

class CvController extends Controller
{
    //ajout de Middleware ('auth')sous form d'un constructeur
    public function __construct()
    {
     $this->middleware('auth');
    }
    // permet de lister les cvs
    public function index(){
       //$listcv =Cv::all();
       //afficher les cv des utilisateurs authentifies les 2 lignes ci dessous
       //$listcv=Cv::where('user_id',auth()->user()->id)->get();
       // çà pour verification de la fonction is_admin
       if(auth()->user()->is_admin){
           $listcv=Cv::all();
       }else {
        $listcv =auth()->user()->cvs;}
        return view('cv.index',['cvs'=> $listcv]);

    }
    //permet d'afficher le formulaire de creation de cv
    public function create (){
       return view('cv.create');
    }
    // permet d'enregistrer un cv
    public function store(cvRequest $request){
       $cv=new Cv();
       $cv->titre=$request->input('titre');
       $cv->presentation=$request->input('presentation');
       //upload une image
       if($request->hasFile('photo')){

       $cv->photo=$request->photo->store('image');
       }
       // forign key
       $cv->user_id = auth()->user()->id;
       $cv->save();
       session()->flash('success','the cv is stored correctly !!');
       return redirect('cvs');
    }
    //permet de recuperer un cv et de le mettre dans un formulaire
    public function edit($id){

        $cv=Cv::find($id);
        //policy
        $this->authorize('update',$cv);

        return view('cv.edit',['cv'=>$cv]);



    }
    //permet de modifier un cv
    public function update(cvRequest $request,$id){
        //recuperer les donnees de la base de donnee
        $cv= Cv::find($id);
        //policy
        $this->authorize('update',$cv);
        //saisir le nouveau titre de cv
        $cv->titre=$request->input('titre');
        //saisir la nouvelle presentation de cv
        $cv->presentation=$request->input('presentation');
        //modifier image
        if($request->hasFile('photo')){

            $cv->photo=$request->photo->store('image');
            }
        //enregister les donneés dans la base de donneés

        $cv->save();
        //positionner dans la vue index
        return redirect('cvs');
    }
    //permet de supprimer un cv
    public function destroy(Request $request,$id){
        //recuperer les donnees de la base de donnee
        $cv=CV::find($id);
        // policy
        $this->authorize('delete',$cv);
        //appliquer la methode delete
        $cv->delete();

        //rediriger vers la vue index(cvs)
        return redirect('cvs');

    }
    public function show($id){
        return view('cv.show', ['id'=>$id]);
    }
    public function getData($id){
        $cv= Cv::find($id);
   $experiences= $cv->experiences()->orderBy("debut","desc")->get();
   $tranings= $cv->tranings()->orderBy("debut","desc")->get();
   $skills= $cv->skills()->orderBy("updated_at","desc")->get();
   $projects= $cv->projects()->orderBy("updated_at","desc")->get();
   return response()->json(['experiences'=>$experiences,
                            'tranings'=>$tranings,
                            'skills'=>$skills,
                            'projects'=>$projects

   ]);

    }
    public function addExperience(Request $request){
        $experience= new Experience;
        $experience->titre= $request->titre;
        $experience->body= $request->body;
        $experience->debut= $request->debut;
        $experience->fin= $request->fin;
        $experience->cv_id= $request->cv_id;

        $experience->save();
        return response()->json(['etat'=>true, 'id'=>$experience->id]);
    }
    public function updateExperience(Request $request){
        $experience=  Experience::find($request->id);
        $experience->titre= $request->titre;
        $experience->body= $request->body;
        $experience->debut= $request->debut;
        $experience->fin= $request->fin;
        $experience->cv_id= $request->cv_id;

        $experience->save();
        return response()->json(['etat'=>true]);
    }
    public function deleteExperience($id){
        $experience=Experience::find($id);
        $experience->delete();
        return response()->json(['etat'=>true]);

    }
    //Module de gestion de traning
    public function addTraning(Request $request){
        $traning= new Traning;
        $traning->titre= $request->titre;
        $traning->description= $request->description;
        $traning->debut= $request->debut;
        $traning->fin= $request->fin;
        $traning->cv_id= $request->cv_id;

        $traning->save();
        return response()->json(['etat'=>true, 'id'=>$traning->id]);
    }
    public function updateTraning(Request $request){
        $traning = Traning::find($request->id);
        $traning->titre= $request->titre;
        $traning->description= $request->description;
        $traning->debut= $request->debut;
        $traning->fin= $request->fin;
        $traning->cv_id= $request->cv_id;

        $traning->save();
        return response()->json(['etat'=>true]);
    }
    public function deleteTraning($id){
        $traning=Traning::find($id);
        $traning->delete();
        return response()->json(['etat'=>true]);

    }

    //module de gestion de skills
    public function addSkill(Request $request){
        $skill= new Skill;
        $skill->titre= $request->titre;
        $skill->description= $request->description;

        $skill->cv_id= $request->cv_id;

        $skill->save();
        return response()->json(['etat'=>true, 'id'=>$skill->id]);
    }
    public function updateSkill(Request $request){
        $skill = Skill::find($request->id);
        $skill->titre= $request->titre;
        $skill->description= $request->description;
        $skill->cv_id= $request->cv_id;

        $skill->save();
        return response()->json(['etat'=>true]);
    }
    public function deleteSkill($id){
        $skill=Skill::find($id);
        $skill->delete();
        return response()->json(['etat'=>true]);

    }
    //module de gestion de skills
    public function addProject(Request $request){
        $project= new Project;
        $project->titre= $request->titre;
        $project->description= $request->description;
        $project->lien= $request->lien;
        $project->image= $request->image;
        $project->cv_id= $request->cv_id;

        $project->save();
        return response()->json(['etat'=>true, 'id'=>$project->id]);
    }
    public function updateProject(Request $request ){
        $project = Project::find($request->id);
        $project->titre= $request('titre');
        $project->description= $request('description');
        $project->lien= $request('lien');
        $project->image= $request('image');
        $project->cv_id= $request('cv_id');

        $project->save();
        return response()->json(['etat'=>true]);
    }
    public function deleteProject($id){
        $project=Project::find($id);
        $project->delete();
        return response()->json(['etat'=>true]);

    }




















































    public function cvExperienceCreate(Request $request, $id) {

        $cv = Cv::find($id);

        $experiences = [
           ["titre" => "Experience en laravel", "body"=>"Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse vestibulum urna vel facilisis cursus. Nam vel tincidunt mauris, pretium ultrices mi.", "debut" => "2013-10-10", "fin" => "2010-12-10"],
           ["titre" => "Experience en symfony", "body"=>"Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse vestibulum urna vel facilisis cursus. Nam vel tincidunt mauris, pretium ultrices mi.", "debut" => "2013-10-10", "fin" => "2010-12-10"],
           ["titre" => "Experience en Sécurité", "body"=>"Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse vestibulum urna vel facilisis cursus. Nam vel tincidunt mauris, pretium ultrices mi.", "debut" => "2013-10-10", "fin" => "2010-12-10"],
           ["titre" => "Experience en Firebase", "body"=>"Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse vestibulum urna vel facilisis cursus. Nam vel tincidunt mauris, pretium ultrices mi.",  "debut" => "2013-10-10", "fin" => "2010-12-10"],
        ];


        foreach($experiences as $exp) {

            $experience = new Experience($exp);


            $cv->experiences()->save($experience);
        }


    }


    public function cvExperienceShow(Request $request, $id) {

        $cv = Cv::find($id);

        return view('experience.show', ['cv' => $cv]);
    }

}
