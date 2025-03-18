<?php

namespace App\Http\Controllers\Api;

use App\Models\Citation;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;

class CitationController extends Controller
{


    /**
     * Display a listing of the resource.
     */
    public function getAllCitations()
    {
        $authors = Citation::pluck('author');
        $contents = Citation::pluck('content');

        return response()->json([
            'authors' => $authors,
            'contents' => $contents
        ]);
    }

    public function storeCitation(Request $request)
    {
        $validated = $request->validate([
            'content' => 'required|string',
            'author' => 'nullable|string|max:255'
        ]);

        if ($request->user()) {
            $validated['user_id'] = $request->user()->id;
        }

        $citation = Citation::create($validated);

        return response()->json([
            'status' => 'success',
            'message' => 'Citation créée avec succès',
            'data' => $citation
        ], Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     */
    public function showCitation(Citation $citation)
    {
        $citation->increment('views');
        $citation->save();
        return response()->json([
            'status' => 'success',
            'data' => $citation
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function updateCitation(Request $request, Citation $citation)
    {

        if (Gate::denies('update_citation', $citation)) {
            return response()->json(['message' => 'You do not have permission to update this citation'], 403);
        }

        $validated = $request->validate([
            'content' => 'required',
            'author' => 'required'
        ]);



        $citation->update($validated);

        return response()->json([
            'status' => 'success',
            'message' => 'Citation mise à jour avec succès',
            'data' => $citation
        ]);
    }


    public function destroyCitation(Citation $citation)
    {

        $citation->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Citation supprimée avec succès'
        ]);
    }
    public function getPopolarCitations()
    {
        $popolarCitations = Citation::orderBy('views', 'desc')->get();
        return response()->json([
            'status' => 'success',
            'data' => $popolarCitations
        ]);
    }

    public function getRandomCitations()
    {
        $randomCitations = Citation::inRandomOrder()->take(1)->get();
        return response()->json([
            'status' => 'success',
            'data' => $randomCitations
        ]);
    }

    public function getCitationByWordCount($length)
    {
        $quotes = Citation::all()->filter(function ($quote) use ($length) {
            return str_word_count($quote->content) <= $length;
        });

        return response()->json($quotes);
    }


    public function approveByAdmin(Citation $citation)
    {


        $citation->status = 'approved';
        $citation->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Citation approuvée avec succès',
            'data' => $citation
        ], 201);
    }
}
